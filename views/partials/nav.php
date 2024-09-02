<?php $active_nav_btn_class = "text-purple-900" ?>

<header class="absolute inset-x-0 top-0 z-50">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">Your Company</span>
                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
            </a>
        </div>
        <div class="flex lg:hidden">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="/" class="<?php if (urlIs("/")) echo $active_nav_btn_class ?> text-sm font-semibold leading-6 text-gray-900">Home</a>
            <a href="/about" class="<?php if (urlIs("/about")) echo $active_nav_btn_class ?> text-sm font-semibold leading-6 text-gray-900">About us</a>
            <?php if ($_SESSION["user"]) : ?>
                <a href="/notes" class="<?php if (urlIs("/notes")) echo $active_nav_btn_class ?> text-sm font-semibold leading-6 text-gray-900">Notes</a>
            <?php endif; ?>
            <a href="/contact" class="<?php if (urlIs("/contact")) echo $active_nav_btn_class ?> text-sm font-semibold leading-6 text-gray-900">Contact</a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            <?php if ($_SESSION["user"] ?? false) : ?>
                <form method="POST" action="/session" class="mr-10">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="text-sm font-semibold leading-6 text-gray-900">Log Out</button>
                    <span aria-hidden="true">&rarr;</span>
                </form>
            <?php else : ?>
                <div class="mr-10">
                    <a href="/register" class="text-sm font-semibold leading-6 text-gray-900">Register</a>
                    <span aria-hidden="true">&rarr;</span>
                </div>
                <div>
                    <a href="/login" class="text-sm font-semibold leading-6 text-gray-900">Login</a>
                    <span aria-hidden="true">&rarr;</span>
                </div>
            <?php endif ?>
        </div>
    </nav>
</header>