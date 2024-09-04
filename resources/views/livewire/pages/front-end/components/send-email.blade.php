<?php

use App\Mail\ContactRequested;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;

new class extends Component {

    use LivewireAlert;

    public $first_name;
    public $last_name;
    public $email;
    public $message;


    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ];
    }


    public function sendMessage()
    {
        $this->validate();

        try {

            $data = [
                'name' => $this->first_name . ' ' . $this->last_name,
                'email' => $this->email,
                'message' => $this->message,
                'subject' => 'Product Inquiry'
            ];

            Mail::to('gsminterior08@gmail.com')->send(new ContactRequested($data));
            $this->reset();
            $this->dispatch('close-modal');
            $this->alert('success', 'Email was send successfully, will get back as soon as possible');

        } catch (Exception $exception) {

            dd($exception->getMessage());
            $this->alert('error', 'There was an error while sending email');

        }

    }

}; ?>

<!-- sendEmail-->
<div wire:ignore.self class="modal fade" id="sendEmailModal" tabindex="-1" aria-labelledby="sendEmailModalLabel"
     aria-hidden="true">
    <form wire:submit="sendMessage">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendEmailModalLabel">Send Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="first_name" class="form-control" wire:model="first_name">
                                @error('first_name')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="last_name" class="form-control" wire:model="last_name">
                                @error('last_name')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" wire:model="email">
                                @error('email')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea rows="4" class="form-control" wire:model="message"></textarea>
                                @error('message')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>



