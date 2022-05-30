<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Admin\Http\Controllers\FrisboController;

class updateStocks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:stocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update subproducts stocks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $frisbo = new FrisboController();
        $frisbo->synchronizeStocks();
    }
}


 = request('message');
        $feedback->status = 'new';

        $feedback->save();

        Mail::send('mails.contactForm.admin', $data, function($message) use ($to){
            $message->to($to, 'Proposes a book')->from('contactmessage@gmail.com')->subject('Proposes a book');
        });

        Session::flash('message', 'Va multumim, in scrut timp managerii nostri va vor contacta.');
        return redirect()->back();
    }

    public function contactFeedBack(Request $request)
    {
        $data['name'] = $request->get('name');
        $data['email'] = $request->get('email');
        $data['contact_message'] = $request->get('message');

        $to = 'iovitatudor@gmail.com';

        $feedback = new FeedBack();
        $feedback->first_name = request('name');
        $feedback->email = request('email');
        $feedback->phone = request('phone');
        $feedback->subject = 'FAQ';
        $feedback->message = request('message');
        $feedback->status = 'new';

        $feedback->save();

        Mail::send('mails.contactForm.admin', $data, function($message) use ($to){
            $message->to($to, 'Contactează-ne')->from('contactmessage@gmail.com')->subject('Contact Us.');
        });

        Session::flash('message', 'Va multumim, in scrut timp managerii nostri va vor contacta.');
        return redirect()->back();
    }
}
