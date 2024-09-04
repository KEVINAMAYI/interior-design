<?php

use App\Mail\ContactRequested;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert;

    public $name;
    public $email;
    public $message;


    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ];
    }


    public function sendMessage()
    {
        $this->validate();

        try {

            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'message' => $this->message,
                'subject' => 'Inquiry'
            ];

            Mail::to('gsminterior08@gmail.com')->send(new ContactRequested($data));
            $this->reset();
            $this->alert('success', 'Email was send successfully, will get back as soon as possible');

        } catch (Exception $exception) {

            $this->alert('error', 'There was an error while sending email');

        }

    }

}; ?>

<!--start page content-->
<div class="page-content">

    <!--start breadcrumb-->
    <div class="py-4 border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class=""><a class="text-decoration-none" href="javascript:;">Home<i
                                class="mx-1 bi bi-chevron-right"></i></a></li>
                    <li class=""><a class="text-decoration-none" href="javascript:;">Pages<i
                                class="mx-1 bi bi-chevron-right"></i></a></li>
                    <li class="text-decoration-none mx-1 active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->


    <!--start product details-->
    <section class="section-padding">
        <div class="container">

            <div class="separator mb-3">
                <div class="line"></div>
                <h3 class="mb-0 h3 fw-bold">Find Us Map</h3>
                <div class="line"></div>
            </div>

            <div class="border p-3">
                <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.817857299221!2d36.82293997358516!3d-1.2831300356197837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f112a045dad53%3A0xdb8d1c72f1ec4f4a!2sTaveta%20Court!5e0!3m2!1sen!2ske!4v1723110427984!5m2!1sen!2ske"  height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="separator my-3">
                <div class="line"></div>
                <h3 class="mb-0 h3 fw-bold">Why Choose Us</h3>
                <div class="line"></div>
            </div>

            <div class="row g-4">
                <div class="col-xl-8">
                    <div class="p-4 border">
                        <form wire:submit="sendMessage">
                            <div class="form-body">
                                <h4 class="mb-0 fw-bold">Get in Touch</h4>
                                <div class="my-3 border-bottom"></div>
                                <div class="mb-3">
                                    <label class="form-label">Enter Your Name</label>
                                    <input type="text" wire:model="name" class="form-control rounded-0">
                                    @error('name')
                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Enter Email</label>
                                    <input type="email" wire:model="email" class="form-control rounded-0">
                                    @error('email')
                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea wire:model="message" class="form-control rounded-0" rows="4"
                                              cols="4"></textarea>
                                    @error('message')
                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-0">
                                    <button type="submit" class="btn btn-dark btn-ecomm">Send Email</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="p-3 border">
                        <div class="address mb-3">
                            <h5 class="mb-0 fw-bold">Address</h5>
                            <p class="mb-0 font-12">Nairobi CBD Odeon, along Taveta Road, Taveta Court Building shop 305/306</p>
                        </div>
                        <hr>
                        <div class="phone mb-3">
                            <h5 class="mb-0 fw-bold">Phone</h5>
                            <p class="mb-0 font-13">0798692688</p>
                        </div>
                        <hr>
                        <div class="email mb-3">
                            <h5 class="mb-0 fw-bold">Email</h5>
                            <p class="mb-0 font-13">gsminterior08@gmail.com</p>
                        </div>
                        <hr>
                        <div class="working-days mb-0">
                            <h5 class="mb-0 fw-bold">Working Days</h5>
                            <p class="mb-0 font-13">Mon - FRI / 8:00 AM - 7:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--start product details-->

</div>
<!--end page content-->

