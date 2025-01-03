<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\CustomerMail;
use App\Models\CustomerSms;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendCustomerMail;
use App\Services\SmsService;

class CustomerController extends Controller
{
    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('customerregister');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customer.create');

    }

    public function showcustomer()
    {
        //
        $customerdatas = Customer::get();

        return view('customer.index', compact('customerdatas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    //Frontend side cusomer store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customer',
            'number' => 'required',
            'address' => 'required',
        ]);

        $customerData = new Customer();
        $customerData->name = $request->name;
        $customerData->email = $request->email;
        $customerData->number = $request->number;
        $customerData->address = $request->address;
        $customerData->save();

        if($request->view == "view"){
            return redirect()->route('customershow')->with('success', 'Customer create successfully.');
        }else{
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Customer::where('id', $id)->delete();
        return redirect()->route('customershow')->with('success', 'Customer Deleted Successfully');
    }

    //Single mail template
    public function singlemailTemp(string $id){

        $customerdata = Customer::find($id);

        return view('customer.singlemailtemp', compact('customerdata'));
    }

    //Single mail send
    public function singlemailsend(Request $request){
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $emailData = [
            'subject' => $request->subject,
            'messages' => $request->message,
        ];
    
        try {
            // Send the email
            Mail::send('customer.mailtemplate', $emailData, function ($message) use ($request) {
                $message->to($request->customer_email)
                        ->subject($request->subject . ' ' . date('d/m/Y H:i'));
            });
    
            // Save the mail data to the database after email is sent
            $customerMail = new CustomerMail();
            $customerMail->customer_id = $request->customer_id;
            $customerMail->customer_email = $request->customer_email;
            $customerMail->subject = $request->subject;
            $customerMail->message = $request->message;
            $customerMail->save();
    
            return redirect()->route('customershow')->with('success', 'Mail sent and data saved successfully.');
    
        } catch (\Exception $e) {
            // Handle errors (email not sent or any other exception)
            return redirect()->route('customershow')->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    //Customer Mail List
    public function customerIndex(){
        $maildatas = CustomerMail::get();

        return view('mail.index', compact('maildatas'));
    }

    // Selected custome temp
    public function mailSend(){
        $customerdatas = Customer::get();

        return view('mail.alltemp',compact('customerdatas'));
    }

    // Selected all custome mail send 
        public function selectedmailsend(Request $request)
    {
        // Validate the request
        $request->validate([
            'emails' => 'required|array',
            'emails.*' => 'email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        foreach ($request->emails as $email) {
            // Prepare email data
            $emailData = [
                'email' => $email,
                'subject' => $request->subject,
                'messages' => $request->message,
            ];

            // Send email
            SendCustomerMail::dispatch($emailData);

            // Optionally save email data to the database
            $customerMail = new CustomerMail();
            $customerMail->customer_email = $email;
            $customerMail->subject = $request->subject;
            $customerMail->message = $request->message;
            $customerMail->save();
        }

        return redirect()->route('allmailsend')->with('success', 'Emails sent successfully.');
    }


    //SMS 

    public function smsindex(){
        $customerdata = CustomerSms::get();

        return view('sms.index', compact('customerdata'));
    }
    
    public function smscreate(string $id){
        $customerdata = Customer::find($id);
        
        return view('sms.sendsms', compact('customerdata'));
    }

    // Send Sms
    public function sendSms(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $to = $request->number;
        $message = $request->message;

        $success = $this->smsService->sendSms($to, $message);

        if ($success) {
            $customerSms = new CustomerSms();
            $customerSms->customer_id = $request->id;
            $customerSms->customer_name = $request->name;
            $customerSms->number = $request->number;
            $customerSms->message = $request->message;
            $customerSms->save();
            return back()->with('success', 'SMS sent successfully.');
        }

        return back()->with('error', 'Failed to send SMS.');
    }
}
