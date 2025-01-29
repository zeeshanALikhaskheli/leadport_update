<?php


namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId(config('google.client_id'));
        $this->client->setClientSecret(config('google.client_secret'));
        $this->client->setRedirectUri(config('google.redirect'));
        $this->client->addScope(Google_Service_Calendar::CALENDAR);

        if ($token = Session::get('google_access_token')) {
            $this->client->setAccessToken($token);
        }

        //dd(Session::get('google_access_token'));
        $this->service = new Google_Service_Calendar($this->client);
    }

    // Redirect to Google for authorization
    public function redirectToGoogle()
    {
        $authUrl = $this->client->createAuthUrl();
        return redirect()->away($authUrl);
    }

    // Handle Google callback and get access token
    public function handleGoogleCallback(Request $request)
    {
        $code = $request->get('code');
        $token = $this->client->fetchAccessTokenWithAuthCode($code);
        Session::put('google_access_token', $token['access_token']);

        return redirect('app-admin/eventss');
    }

    // View events from the user's calendar
    public function viewEvents()
    {   
        //dd(Session::get('google_access_token'));
        if (!$token = Session::get('google_access_token')) {
            return redirect('app-admin/auth/redirect');
        }
        //dd($token);
        $this->client->setAccessToken($token);
        
        $events = $this->service->events->listEvents('primary');
        $eventDetails = [];
        foreach ($events->getItems() as $event) {
            $eventDetails[] = [
                'id' => $event->getId(),
                'title' => $event->getSummary(),
                'description' => $event->getDescription(),
                'start' => $event->getStart()->getDateTime(),
                'end' => $event->getEnd()->getDateTime(),
                'htmlLink' => $event->getHtmlLink(),
            ];
        }
        
        return view('landlord.calendar.calendar', ['events' => $eventDetails]);
    }

    // Create a new event in the user's calendar
    public function createEvent(Request $request)
    {
        
        if (!$token = Session::get('google_access_token')) {
            return redirect('app-admin/auth/redirect');
        }
    
        $this->client->setAccessToken($token);
    
        // Check if the token is expired and refresh if necessary
        if ($this->client->isAccessTokenExpired()) {
            $refreshToken = $token ?? null; // Get refresh token from the token array
            //dd($token);
            if ($refreshToken) {
                $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
                Session::put('google_access_token', $this->client->getAccessToken());
            } else {
                return redirect('app-admin/auth/redirect');
            }
        }

        //dd($request->all());

        $start_date = new \DateTime($request->start_date);
        $start_date = $start_date->format(\DateTime::ISO8601);
        $end_date   = new \DateTime($request->end_date);
        $end_date   = $end_date->format(\DateTime::ISO8601);


        //dd($dateTime);
       // dd($request->start_date);
        $event = new Google_Service_Calendar_Event([
            'summary'      => $request->title,
            'description'  => $request->description,
            'start' => [
                'dateTime' => $start_date,
                'timeZone' => 'GMT-03:00',
            ],
            'end' => [
                'dateTime' => $end_date,
                'timeZone' => 'GMT-03:00',
            ],
        ]);

        try {
            $this->service->events->insert('primary', $event);
        } catch (Exception $e) {
            return redirect('app-admin/eventss')->with('error', 'Failed to create event: ' . $e->getMessage());
        }

        return redirect('app-admin/eventss');
    }


    public function updateEvent(Request $request)
    {

        //dd($request->all());
        if (!$token = Session::get('google_access_token')) {
            return redirect('app-admin/auth/redirect');
        }

        $this->client->setAccessToken($token);

        // Check if the token is expired and refresh if necessary
        if ($this->client->isAccessTokenExpired()) {
            $refreshToken = $token['refresh_token'] ?? null;
            if ($refreshToken) {
                $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
                Session::put('google_access_token', $this->client->getAccessToken());
            } else {
                return redirect('app-admin/auth/redirect');
            }
        }

        // Retrieve the event ID from the request
        $eventId = $request->event_id;

        $start_date = new \DateTime($request->start_date);
        $start_date = $start_date->format(\DateTime::ISO8601);
        $end_date   = new \DateTime($request->end_date);
        $end_date   = $end_date->format(\DateTime::ISO8601);
        //dd($end_date);
        // Prepare the updated event details
        $event = new Google_Service_Calendar_Event([
            'summary'      => $request->title,
            'description'  => $request->description,
            'start' => [
                'dateTime' => $start_date,
                'timeZone' => 'GMT-03:00',
            ],
            'end' => [
                'dateTime' => $end_date,
                'timeZone' => 'GMT-03:00',
            ],
        ]);

        try {
            // Update the event
            $this->service->events->update('primary', $eventId, $event);
        } catch (\Exception $e) {
            return redirect('app-admin/eventss')->with('error', 'Failed to update event: ' . $e->getMessage());
        }
        
        return redirect('app-admin/eventss');
    }


    public function deleteEvent($eventId)
    {
    if (!$token = Session::get('google_access_token')) {
        return redirect('app-admin/auth/redirect');
    }

    $this->client->setAccessToken($token);

    // Check if the token is expired and refresh if necessary
    if ($this->client->isAccessTokenExpired()) {
        $refreshToken = $token['refresh_token'] ?? null; // Get refresh token from the token array
        if ($refreshToken) {
            $this->client->fetchAccessTokenWithRefreshToken($refreshToken);
            Session::put('google_access_token', $this->client->getAccessToken());
        } else {
            return redirect('app-admin/auth/redirect');
        }
    }

    try {
        $this->service->events->delete('primary', $eventId);
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
   }

   public function logout()
   {
       // Clear the session
       Session::forget('google_access_token');
       return redirect('https://accounts.google.com/Logout');
   }

}
