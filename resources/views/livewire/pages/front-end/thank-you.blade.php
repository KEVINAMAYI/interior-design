<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {}; ?>

<!--start page content-->
<div class="page-content">

    <!--start breadcrumb-->
    <div class="py-4 border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="text-decoration-none"><a class="text-decoration-none" href="javascript:;">Home <i class="mx-1 bi bi-chevron-right"></i></a></li>
                    <li class="text-decoration-none"><a class="text-decoration-none" href="javascript:;">Pages <i class="mx-1 bi bi-chevron-right"></i></a></li>
                    <li class="text-decoration-none active" aria-current="page">Thank You</li>
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
                <h3 class="mb-0 h3 fw-bold">Thank You!</h3>
                <div class="line"></div>
            </div>

            <div class="border p-4 text-center w-100">
                <h5 class="fw-bold mb-2">Thank You for Contacting us.</h5>
                <p class="mb-0">We have recived your message. We will reply you as soon as possible.</p>
            </div>

        </div>
    </section>
    <!--start product details-->

</div>
<!--end page content-->

