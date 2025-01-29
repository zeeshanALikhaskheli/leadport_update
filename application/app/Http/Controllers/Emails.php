<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Email;
use Illuminate\Http\Request;
use App\Models\LogisticsData;
use Webklex\IMAP\Facades\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use GeminiAPI\Laravel\Facades\Gemini;
use App\Models\CustomTicket;

class Emails extends Controller
{

    public function updateAppPassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'app_password' => 'required',
        ]);
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Save the app password directly
        $user->app_password = $request->app_password;
        $user->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'App password saved successfully!');
    }


    public function fetchEmails($fromCommand = false)
    {
        try {

            if ($fromCommand) {
                return true; // Return true for command line execution
            }
         
            // Connect to the IMAP server
            $client = Client::account('default');
            $client->connect();
    
            // Access the INBOX folder
            $folder = $client->getFolder('INBOX');
    
            // Fetch unseen messages
            $messages = $folder->query()
                ->since(now()->subDays(1)) // Emails from the last day
                ->unseen()
                ->limit(5)
                ->setFetchOrder("desc")
                ->get();
    
           
    
            foreach ($messages as $message) {
                $uid = $message->getUid();
    
                // Check if email with this UID already exists
                if (!Email::where('uid', $uid)->exists()) {
                    $emailBody = $message->getTextBody() ?? 'No Body Content';
                    $logisticsData = $this->getNLPData($emailBody);
                    
                    // Save the email to the database
                    $email = Email::create([
                        'uid'           => $uid,
                        'subject'       => $message->getSubject() ?? 'No Subject',
                        'from'          => $message->getFrom()[0]->mail ?? 'Unknown Sender',
                        'body'          => $emailBody,
                        'logistics_data' => $logisticsData ? json_encode($logisticsData) : null,// Store the filtered logistics data
                        'received_at'   => $message->getDate(),
                        'email_to'=>$message->getTo()[0]->mail ?? 'Unknown Sender',
                        // Save logistics data directly in the emails table
                'request_type' => $logisticsData['request_type'] ?? null,
                'quantity' => $logisticsData['quantity'] ?? null,
                'shipping_date' => $logisticsData['shipping_date'] ?? null,
                'shipping_time' => $logisticsData['shipping_time'] ?? null,
                'shipper_name' => $logisticsData['shipper_name'] ?? null,
                'shipper_country' => $logisticsData['shipper_country'] ?? null,
                'shipper_city' => $logisticsData['shipper_city'] ?? null,
                'shipper_address' => $logisticsData['shipper_address'] ?? null,
                'pickup_remarks' => $logisticsData['pickup_remarks'] ?? null,
                'shipping_carrier' => $logisticsData['shipping_carrier'] ?? null,
                'transport_mode' => $logisticsData['transport_mode'] ?? null,
                'container_type' => $logisticsData['container_type'] ?? null,
                'cargo_weight_kg' => $logisticsData['cargo_weight_kg'] ?? null,
                'cargo_type' => $logisticsData['cargo_type'] ?? null,
                'origin' => $logisticsData['origin'] ?? null,
                'destination' => $logisticsData['destination'] ?? null,
                'delivery_date' => $logisticsData['delivery_date'] ?? null,
                'delivery_time' => $logisticsData['delivery_time'] ?? null,
                'consignee_name' => $logisticsData['consignee_name'] ?? null,
                'consignee_country' => $logisticsData['consignee_country'] ?? null,
                'consignee_city' => $logisticsData['consignee_city'] ?? null,
                'consignee_address' => $logisticsData['consignee_address'] ?? null,
                'delivery_remarks' => $logisticsData['delivery_remarks'] ?? null,
                'carrier_for_delivery' => $logisticsData['carrier_for_delivery'] ?? null,
                'temperature_sensitive' => $logisticsData['temperature_sensitive'] ?? null,
                'temperature_range' => $logisticsData['temperature_range'] ?? null,
                'adr' => $logisticsData['adr'] ?? null,
                'un_code' => $logisticsData['un_code'] ?? null,
                'fragile' => $logisticsData['fragile'] ?? null,
                'notes' => $logisticsData['notes'] ?? null,
                'chargeable_weight' => $logisticsData['chargeable_weight'] ?? null,
                'ticket_user_id' => $logisticsData['ticket_user_id'] ?? null,
                    ]);

                   
      
    
                  
                }
            }

        // Get the currently authenticated user's email
         $userEmail = auth()->user()->email;
    
                // dd($userEmail);
            // Fetch saved emails from the database to send to the view
            // $savedEmails = Email::latest('received_at')->get();
            $savedEmails = Email::where('email_to', $userEmail)
            ->latest('received_at')
            ->get();

    
            $page = [
                'heading' => 'Email Parser',
                'crumbs' => ['Email Parser'],
            ];
            
         
    
            // Return the view with saved emails and logistics data (only weight and origin)
            return view('pages.emails.wrapper', [
                'emails' => $savedEmails,
                'totalEmails' => $savedEmails->count(),
                'page' => $page,
                
            ]);
    
        } catch (\Exception $e) {
            Log::error('Error fetching emails: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch emails: ' . $e->getMessage()], 500);
        }
    }
 
    
    // Function to process email body through Gemini API for logistics data extraction
    private function getNLPData($text)
    {
        try {
            // Use Gemini API to get structured logistics data
            $response = Gemini::generateText('You are a system for extracting structured logistics details from emails. Analyze the following email text and return a JSON object with the following fields:
                - "request_type" (e.g., "price_quote", "shipment_update").
                - "quantity" (total quantity of goods).
                - "shipping_date" (e.g., "2025-01-15").
                - "shipping_time" (e.g., "10:00 AM").

                Shipper Details:
                - "shipper_name" (name of the shipper).
                - "shipper_country" (country of the shipper).
                - "shipper_city" (city of the shipper).
                - "shipper_address" (address of the shipper).
                - "pickup_remarks" (special instructions for pickup).
                
                Shipping Details:
                - "shipping_carrier" (company responsible for shipping).
                - "transport_mode" (e.g., "sea", "air").
                - "container_type" (e.g., "20ft", "40ft").
                - "cargo_weight_kg" (weight in kilograms).
                - "cargo_type" (e.g., "electronics").
                - "origin" (starting location).
                - "destination" (end location).
                
                Delivery Details:
                - "delivery_date" (e.g., "2025-01-17").
                - "delivery_time" (e.g., "3:00 PM").
                - "consignee_name" (name of the consignee).
                - "consignee_country" (country of the consignee).
                - "consignee_city" (city of the consignee).
                - "consignee_address" (address of the consignee).
                - "delivery_remarks" (special instructions for delivery).
                - "carrier_for_delivery" (delivery company).
                
                Special Requirements:
                - "temperature_sensitive" (e.g., "yes", "no").
                - "temperature_range" (e.g., "2-8°C").
                - "adr" (applicable ADR codes, if any).
                - "un_code" (UN code of goods).
                - "fragile" (e.g., "yes", "no").
                - "notes" (additional instructions).
                
                Additional Information:
                - "chargeable_weight" (weight for billing purposes).
                - "ticket_user_id" (unique user ID of the ticket).
                
                Email Content:
                '.$text.' 
                Respond only with the JSON object.');

           // Clean the response
        $cleanedResponse = preg_replace('/"{3}|```(JSON)?/i', '', $response); // Remove backticks or extraneous tags
        $cleanedResponse = trim($cleanedResponse); // Trim whitespace
        $decodedResponse = json_decode($cleanedResponse, true); // Decode to an associative array

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('JSON Decode Error: ' . json_last_error_msg());
            return [];
        }

        // Log the cleaned response
        Log::info('Cleaned Gemini Response: ' . print_r($decodedResponse, true));

        

        return $decodedResponse;

            // dd($extractedData);
            // Log the raw response for debugging purposes
            // Log::info('Gemini API Raw Response: ' . print_r($response, true));
            // log::info($response);

            // return $response;



        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error processing email with Gemini API: ' . $e->getMessage());
            return [];
        }
    }

    public function show($emailId)
{
    // Fetch the email data based on the ID
    $email = Email::findOrFail($emailId);

       // Batch requests for better performance
       $requests  = [
        'loadType'          => 'App\Models\CTicketLoadType',
        'countries'         => 'App\Models\CTicketCountry',
        'transportChannels' => 'App\Models\CTicketTransportChannel',
        'carriageType'      => 'App\Models\CTicketCarriageType',
        'orderTypes'        => 'App\Models\CTicketOrderType',
        'orderStatus'       => 'App\Models\CTicketStatus',
        'incoterms'         => 'App\Models\CTicketIncoterms',
        'teamUsers'          => 'App\Models\User',
        
     ];   
    // Batch processing of requests
    $responses = [];
    // foreach ($requests as $key => $requestUrl) {
    //     $responses[$key] = $this->fetchData($requestUrl);
    // }

    $page = [
        'heading' => 'create',
        'crumbs' => ['create'],
    ];
    
    // $page               = $this->pageSettings('create');
    $loadType           = $responses['loadType']?? null;
    $countries          = $responses['countries']?? null;
    $transportChannels  = $responses['transportChannels']?? null;
    $carriageType       = $responses['carriageType']?? null;
    $orderTypes         = $responses['orderTypes']?? null;
    $orderStatus        = $responses['orderStatus']?? null;
    $incoterms          = $responses['incoterms']?? null;
    $teamUsers = \App\Models\User::where('type','team')->get();



    // dd($teamUsers);
//show the view
return view('pages.emails.components.create.wrapper',compact('email','teamUsers','page','loadType','countries','transportChannels','carriageType','orderTypes','orderStatus','incoterms'));


    // dd($email);
    // Pass the email data to the view
    // return view('pages.customtickets.wrapper', compact('email','page', 'tickets', 'users'));
}
    


 
}

