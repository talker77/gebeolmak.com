<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\SiteContactMail;
use App\Models\Ayar;
use App\Models\Contact;
use App\Repositories\Traits\ResponseTrait;
use Illuminate\Support\Facades\Mail;

class IletisimController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $site = Ayar::getCache();

        return view('site.iletisim.iletisim', compact('site'));
    }

    public function sendMail(ContactRequest $request)
    {
        try {
            $data = $request->validated();
            Contact::create($data);
            //Mail::to(env('MAIL_USERNAME'))->send(new SiteContactMail($data));
            return $this->success([],'Mesajınız alındı yakında sizinle iletişime geçeçeğiz');
        } catch (\Exception $exception) {
            $this->error("Mesajı göndeririken hata oluştu daha sonra tekrar deneyi");
            return back();
        }
    }
}
