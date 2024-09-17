<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {

    public function deleteUser(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);

    }
};

?>

<section class="space-y-6">

    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>
    <form wire:submit="deleteUser" class="p-6">
        <button type="submit" class="btn btn-outline-danger waves-effect">
            <span wire:loading.remove>Delete Account</span>
            <span wire:loading>Loading...</span>
        </button>
    </form>
</section>
