<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for tickets
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use Validator;
use App\Models\Lead;
use App\Models\User;
use App\Models\Event;
use App\Models\TicketForm;
use App\Models\CTicketGood;
use App\Models\CustomTicket;
use Illuminate\Http\Request;
use App\Models\EventTracking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class TicketController extends Controller {

    /**
     * Display a listing of tickets
     * @param object CategoryRepository instance of the repository
     * @return blade view | ajax view
     */


     public function index()
     {
         // Fetch all tickets ordered by 'id' in descending order
         $tickets = CustomTicket::orderby('id', 'DESC')->get();
     
         $page = $this->pageSettings('tickets');
     
         // Initialize an array to store user names associated with each ticket
         $users = [];
     
         // Iterate through each ticket to fetch assigned user names
         foreach ($tickets as $ticket) {
             // Decode the assigned column for each ticket
             $assignedUserIds = json_decode($ticket->assigned, true);
     
             if (is_array($assignedUserIds)) {
                 // Fetch the user names for the decoded user IDs
                 $users[$ticket->id] = User::whereIn('id', $assignedUserIds)->pluck('first_name')->toArray();
             } else {
                 // If no assigned users, set an empty array
                 $users[$ticket->id] = [];
             }
         }
     
        //  dd($users);
         // Pass data to the view
         return view('pages.customtickets.wrapper', compact('page', 'tickets', 'users'));
        
     }
     
    // public function index() {

    //     $result   = CustomTicket::orderby('id','DESC')->get();

    //     $tickets  = $result?? null;
    //     $page     = $this->pageSettings('tickets');

      
    //     // $ticket = CustomTicket::where('id',$id)->first();
    //     // $lead   = Lead::where('ticket_id',$id)->first();
    //     $assignedUserIds = json_decode($tickets->assigned, true);

    //     $users = User::where('id', $assignedUserIds)->pluck('full_name');
    //     // $users = User::where('id', 1)->pluck('first_name');

    //     dd($users);

        
        
    //     return view('pages.customtickets.wrapper',compact('page','tickets','users'));
    // }


    public function fetchData($model) {

            $response = $model::get();
            return $response;
    }

    /**
     * Show the form for creating a new ticket
     * @return \Illuminate\Http\Response
     */
    public function create() {

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
            foreach ($requests as $key => $requestUrl) {
                $responses[$key] = $this->fetchData($requestUrl);
            }
            
            $page               = $this->pageSettings('create');
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
        return view('pages.customtickets.components.create.wrapper',compact('teamUsers','page','loadType','countries','transportChannels','carriageType','orderTypes','orderStatus','incoterms'));
    }


    /**
     * Generate a new link for ticket form
     * @return \Illuminate\Http\Response
     */

    public function generateLink(Request $request)
    {
        // Generate a unique ID
        $uniqueId = 'formID' . bin2hex(random_bytes(10)); // More secure unique ID
        $expiryDate = now()->addDays(7); // Optional expiry date

        // Store the unique ID in the database
        $form = new TicketForm();
        $form->share_id = $uniqueId;
        $form->expiry_date = $expiryDate; // Optional
        $form->save();

        // Return the generated link
        $appURL = url('/ctickets/form');
        return response()->json(['link' => "{$appURL}?share_id={$uniqueId}"]);
    }


    /**
     * Show the form for creating a new ticket for client side
     * @return \Illuminate\Http\Response
     */
    public function ticketForm(Request $request)
    {

        $shareId = $request->query('share_id');

        // Validate the share_id
        $form = TicketForm::where('share_id', $shareId)
                    ->where('expiry_date', '>', now()) // Check if not expired
                    ->first();
        if (!$form) {
            return view('errors.404'); // Or redirect to an error page
        }

        // Batch requests for better performance
        $requests = [
            'loadType'          => 'App\Models\CTicketLoadType',
            'countries'         => 'App\Models\CTicketCountry',
            'carriageType'      => 'App\Models\CTicketCarriageType',
            'incoterms'         => 'App\Models\CTicketIncoterms',
            'teamUsers'          => 'App\Models\User',
        ];
        
        // Batch processing of requests
        $responses = [];
        foreach ($requests as $key => $requestUrl) {
            $responses[$key] = $this->fetchData($requestUrl);
        }
        
        
        $page               = $this->pageSettings('form');
        $countries          = $responses['countries']?? null;
        $loadType           = $responses['loadType']?? null;
        $carriageType       = $responses['carriageType']?? null;
        $incoterms          = $responses['incoterms']?? null;
        $ticket             = CustomTicket::where('uniqueId',$shareId)->first();
        $teamUsers = \App\Models\User::where('type', 'team')->get();


        //show the view
        return view('pages.customtickets.components.request.page',compact('page','countries','loadType','carriageType','incoterms','ticket','teamUsers'));
    }


    /**
     * Store a newly created ticket  in storage.
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        //dd($request->deliveryRemarks);
        $goods = [];
        $goods = $request->goods;

        unset($request['goods']);
        unset($request['totalQuantity']);
        unset($request['totalWeight']);
        unset($request['totalLDM']);
        unset($request['totalVolume']);
        unset($request['system_language']);
        unset($request['user_has_due_reminder']);
        unset($request['resource_query']);
        unset($request['system_languages']);
        unset($request['projects_menu_list']);    
        unset($request['visibility_left_menu_toggle_button']);

        $arrayFields = ['assigned'];

        foreach ($arrayFields as $field) {
            if (is_array($request->get($field))) {
                $request->merge([
                    $field => json_encode($request->get($field)), // Convert array to JSON
                ]);
            }
        }


        $createTicket = CustomTicket::create($request->all());
      










        

        if(isset($goods) && count($goods) > 0 && isset($createTicket->id)){

                foreach($goods as $good){
                    $good['ticket_id'] = $createTicket->id;
                    $createGoods = CTicketGood::create($good);
                }

        }

         if(isset($createTicket->id)){    

            $data = [
                'event_creatorid' => auth()->id() ?? 1,
                'event_item' => 'custom-ticket',
                'event_item_id' => 0,
                'event_item_lang' => 'event_closed_ticket',
                'event_item_content'  => $request->shipper_name,
                'event_item_content2' => $request->consignee_name,
                'event_parent_type' => 'ticket',
                'event_parent_id' => 0,
                'event_show_item' => 'yes',
                'event_show_in_timeline' => 'yes',
                'eventresource_type' => 'project',
                'event_notification_category' => 'notifications_tickets_activity',
            ];

            //record event
            if ($event_id = Event::create($data)) {
                
                $eventtracking = new EventTracking;
                $eventtracking->eventtracking_eventid = $event_id->event_id;
                $eventtracking->eventtracking_userid  = $event_id->event_creatorid ?? 1;
                $eventtracking->eventtracking_source  = 'ticket';
                $eventtracking->eventtracking_source_id = 0;
                $eventtracking->parent_type = 'ticket';
                $eventtracking->parent_id = 0;
                $eventtracking->resource_type = 'project';
                $eventtracking->resource_id = 0;
                $eventtracking->save();

                //$redirectUrl = route('ctickets.index');        
                //redirect to ticket
                //config(['visibility.modules.projects' => true]);

                $jsondata['type'] = 'type';
                $jsondata['value'] =  __('lang.request_has_been_completed');
                
    
                // $jsondata['redirect_url'] = url('ctickets/index');
                Artisan::call('config:clear');
                Artisan::call('view:clear');
                Artisan::call('route:clear');
                $jsondata['redirect_url'] = route('ctickets.index');
                // Artisan::call('config:clear');
                // Artisan::call('view:clear');
                // Artisan::call('route:clear');
                        
                //response
                return response()->json($jsondata);

                // return response()->json(array(
                //     'notification' => [
                //         'type' => 'success',
                //         'value' => __('lang.request_has_been_completed'),
                //     ],
                //     'skip_dom_reset' => true,
                //     'redirect' => $redirectUrl,
                // ));
            }
            
        }else{
            return response()->json(array(
                'notification' => [
                    'type' => 'error',
                    'value' => __('lang.error_request_could_not_be_completed'),
                ],
                'skip_dom_reset' => true,
            ));
        }

    }

    /**
     * Display the specified ticket
     * @param object TicketReplyRepository instance of the repository
     * @param int $id ticket  id
     * @return \Illuminate\Http\Response
     */

    public function view($id){

        

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
        foreach ($requests as $key => $requestUrl) {
            $responses[$key] = $this->fetchData($requestUrl);
        }
        
        // Accessing individual responses
        $transportType      = $responses['transportType']?? null;
        $equipmentType      = $responses['equipmentType']?? null;
        $loadType           = $responses['loadType']?? null;
        $countries          = $responses['countries']?? null;
        $transportChannels  = $responses['transportChannels']?? null;
        $carriageType       = $responses['carriageType']?? null;
        $orderTypes         = $responses['orderTypes']?? null;
        $orderStatus        = $responses['orderStatus']?? null;
        $incoterms          = $responses['incoterms']?? null;
          $teamUsers = \App\Models\User::where('type', 'team')->get();
        

        $ticket = CustomTicket::where('id',$id)->first();
        $lead   = Lead::where('ticket_id',$id)->first();
        $assignedUserIds = json_decode($ticket->assigned, true);

        // $users = User::where('id', $assignedUserIds)->pluck('full_name');

        if (!$ticket) {
            abort(409, __('lang.ticket_not_found'));
        }

        if (isset($lead)) {
            $ticket['is_lead_convarted'] = true;
        }

        $ticket['viewmode'] = true;
        $page = $this->pageSettings('tickets');
        $ticket            = $ticket;
        $loadType          = $loadType;
        $countries           = $countries;
        $transportChannels = $transportChannels;
        $carriageType      = $carriageType;
        $orderTypes        = $orderTypes;
        $orderStatus       = $orderStatus;
        $incoterms         = $incoterms;
        // $users             =$users;

        // dd($ticket);
    //response
    return view('pages.customticket.wrapper',compact('page','ticket','loadType','countries','transportChannels','carriageType','orderTypes','orderStatus','incoterms'));
    
  }


    /**
     * Show the form for editing the specified ticket
     * @param object CategoryRepository instance of the repository
     * @param int $id ticket id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

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
            foreach ($requests as $key => $requestUrl) {
                $responses[$key] = $this->fetchData($requestUrl);
            }
            
            // Accessing individual responses
            $loadType           = $responses['loadType']?? null;
            $countries          = $responses['countries']?? null;
            $transportChannels  = $responses['transportChannels']?? null;
            $carriageType       = $responses['carriageType']?? null;
            $orderTypes         = $responses['orderTypes']?? null;
            $orderStatus        = $responses['orderStatus']?? null;
            $incoterms          = $responses['incoterms']?? null;

            $ticket = CustomTicket::where('id',$id)->first();
            $lead   = Lead::where('ticket_id',$id)->first();
            $teamUsers = \App\Models\User::where('type', 'team')->get();

            if (!$ticket) {
                abort(409, __('lang.ticket_not_found'));
            }

            if (isset($lead)) {
                $ticket['is_lead_convarted'] = true;
            }

 
            $page = $this->pageSettings('tickets');
            $ticket            = $ticket;
            $loadType          = $loadType;
            $countries         = $countries;
            $transportChannels = $transportChannels;
            $carriageType      = $carriageType;
            $orderTypes        = $orderTypes;
            $orderStatus       = $orderStatus;
            $incoterms         = $incoterms;
    
            //dd($ticket);
        //response
        return view('pages.customticket.wrapper',compact('page','ticket','loadType','countries','transportChannels','carriageType','orderTypes','orderStatus','incoterms'));
    }

    
    public function convartToLead(Request $request,$id)
    {       
        
            $lead = Lead::where('ticket_id',$id)->first();

            if(isset($lead)) {
                abort(409, __('lang.already_ticket_convart_lead'));
            }

            $order_type        = $this->getModelInfo('App\Models\CTicketOrderType',$request->ticket_order_type_id);
            $incoterms         = $this->getModelInfo('App\Models\CTicketIncoterms',$request->ticket_incoterms_id);
            $load_type         = $this->getModelInfo('App\Models\CTicketLoadType',$request->ticket_loadtype_id);
            $shipper_country   = $this->getModelInfo('App\Models\CTicketCountry' ,$request->shipping_country_id);
            $consignee_country = $this->getModelInfo('App\Models\CTicketCountry' ,$request->delivery_country_id);

            $baseUrl = env('APP_URL');
            //dd($request->all());
            $leadTitle = $shipper_country->name.'-'.$consignee_country->name."($request->shipping_date - $request->delivery_date)";
            $leadDescription ="
            <a href='$baseUrl/ctickets/$id/edit' }}'>Ticket ID : $id</a><br>
            <p><strong>General Information</strong></p>
            <p>$order_type->name, $incoterms->name, $load_type->name, $request->quantity</p>
            <p><strong>Shipper: </strong>$request->shipper_name</p>
            <p><strong>Pickup:</strong></p>
            <p>$request->shipping_city, &nbsp;   $shipper_country->name, &nbsp; $request->shipping_address, &nbsp; $request->shipping_index</p>
            <p><strong>Consignee: </strong>$request->consignee_name</p>
            <p><strong>Delivery:</strong></p>
            <p>$request->delivery_city, &nbsp;   $consignee_country->name, &nbsp;  $request->delivery_address, &nbsp; $request->delivery_index</p>
            <p><strong>Goods:</strong></p>
            <p>$request->totalQuantity, &nbsp;   $request->totalWeight, &nbsp;  $request->totalLDM, &nbsp;  $request->totalVolume</p>
            <p><strong>Additional Information:</strong></p>
            <p>$request->temp_sensitive, &nbsp;  $request->temp_range, &nbsp;  $request->adr, &nbsp;  $request->un_code, &nbsp;  $request->fragile,  &nbsp;  $request->notes</p>
            ";

            $lead = new Lead;
            $lead->ticket_id  = $id;
            $lead->lead_title = $leadTitle;
            $lead->lead_description = $leadDescription;
        
            if($lead->save() && isset($lead->lead_id)){

                $data = [
                    'event_creatorid' => auth()->id() ?? 1,
                    'event_item' => 'lead',
                    'event_item_id' => $lead->lead_id.'/'.$leadTitle,
                    'event_item_lang' => 'event_closed_leads',
                    'event_item_content'  => $request->shipper_name,
                    'event_item_content2' => $request->consignee_name,
                    'event_parent_type' => 'leads',
                    'event_parent_id' => $lead->lead_id,
                    'event_show_item' => 'yes',
                    'event_show_in_timeline' => 'yes',
                    'eventresource_type' => 'project',
                    'event_notification_category' => 'notifications_leads_activity',
                ];
    
                //record event
                if ($event_id = Event::create($data)) {
                    
                    $eventtracking = new EventTracking;
                    $eventtracking->eventtracking_eventid = $event_id->event_id;
                    $eventtracking->eventtracking_userid  = $event_id->event_creatorid ?? 1;
                    $eventtracking->eventtracking_source  = 'leads';
                    $eventtracking->eventtracking_source_id = 0;
                    $eventtracking->parent_type = 'leads';
                    $eventtracking->parent_id = $lead->lead_id;
                    $eventtracking->resource_type = 'project';
                    $eventtracking->resource_id = $lead->lead_id;
                    $eventtracking->save();
                    return response()->json(array(
                        'notification' => [
                            'type' => 'success',
                            'value' => __('lang.request_has_been_completed'),
                        ],
                        'skip_dom_reset' => true,
                    ));
                }
            }


    }

    public function getModelInfo($model,$id){

        return  $model::where('id',$id)->first('name');
    }

    public function updateTicketDetails(Request $request, $id){
          
        $goods = [];
        $goods = $request->goods;

        unset($request['goods']);
        unset($request['totalQuantity']);
        unset($request['totalWeight']);
        unset($request['totalLDM']);
        unset($request['totalVolume']);
        unset($request['system_language']);
        unset($request['user_has_due_reminder']);
        unset($request['resource_query']);
        unset($request['system_languages']);
        unset($request['projects_menu_list']);    
        unset($request['visibility_left_menu_toggle_button']);


        $updateTicket = CustomTicket::where('id',$id)->update($request->all());

        if(isset($goods) && count($goods) > 0 && isset($updateTicket)){

                $deleteOlds = CTicketGood::where('ticket_id',$id)->delete();

                foreach($goods as $good){
                    $good['ticket_id'] = $id;
                    $updateGoods = CTicketGood::create($good);
                }

        }
          
        if(isset($updateTicket)){
            $redirectUrl = route('ctickets.index');
            return response()->json(array(
                'notification' => [
                    'type' => 'success',
                    'value' => __('lang.request_has_been_completed'),
                ],
                'skip_dom_reset' => true,
                'redirect' => $redirectUrl,
            ));
        }else{
            return response()->json(array(
                'notification' => [
                    'type' => 'error',
                    'value' => __('lang.error_request_could_not_be_completed'),
                ],
                'skip_dom_reset' => true,
            ));
        }
         

}


    public function destroyTicket($id)
    {

        $deleteTicket = CustomTicket::where('id',$id)->delete();

        if($deleteTicket){
            $deleteTicket = CTicketGood::where('ticket_id',$id)->delete();
        }

        if($deleteTicket){
            
            return response()->json(array(
                'notification' => [
                    'type' => 'success',
                    'value' => __('lang.request_has_been_completed'),
                ],
                'skip_dom_reset' => true,
            ));
        }else{
            return response()->json(array(
                'notification' => [
                    'type' => 'error',
                    'value' => __('lang.error_request_could_not_be_completed'),
                ],
                'skip_dom_reset' => true,
            ));
        }

    }


    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.tickets'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'tickets',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_ctickets' => 'active',
            'sidepanel_id' => 'sidepanel-filter-tickets',
            'dynamic_search_url' => url('tickets/search?action=search&ticketresource_id=' . request('ticketresource_id') . '&ticketresource_type=' . request('ticketresource_type')),
            'load_more_button_route' => 'tickets',
            'source' => 'list',
            'crumbs_col_size' => 'col-lg-5',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_button_link_url' => url('tickets/create'),
        ];

        //tickets list page
        if ($section == 'tickets') {
            $page += [
                'meta_title' => __('lang.tickets'),
                'heading' => __('lang.tickets'),
                'mainmenu_ctickets' => 'active',
            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        //tickets list page
        if ($section == 'create') {
            $page['crumbs'] = [
                __('lang.tickets'),
                __('lang.create_new_ticket'),
            ];
            $page += [
                'meta_title' => __('lang.open_support_ticket'),
                'heading' => __('lang.tickets'),
                'mainmenu_ctickets' => 'active',
            ];
            return $page;
        }

         //tickets form for client
        if ($section == 'form') {
            $page += [
                'page_title' => __('lang.create_new_ticket'),
                'meta_title' => __('lang.open_support_ticket'),
                'heading' => __('lang.tickets'),
                'mainmenu_ctickets' => 'active',
            ];
            return $page;
        }

        //ticket page
        if ($section == 'ticket') {
            $page['crumbs'] = [
                __('lang.support_tickets'),
                __('lang.id') . ' #' . $data->ticket_id,
            ];
            $page['page'] = 'ticket';
            $page['heading'] = $data->ticket_subject;
            $page['crumbs_col_size'] = 'col-lg-9';
            return $page;
        }

        //return
        return $page;
    }

}