<template>
    <div class="container ">
        <nav
            class="flex items-center justify-between flex-row bg-black h-16 overflow-hidden"
        >
            <div class="container-fluid flex items-center flex-shrink-0">
                <span class="font-semibold text-xl tracking-tight"
                    >Radical Flexibility</span
                >
            </div>
            <div class="block lg:hidden">
                <button
                    class="flex items-center px-3 py-2 border rounded border-white hover:text-gray-300 hover:border-gray-300"
                >
                    <svg
                        class="h-3 w-3"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            d="M0 4.4C0 3.6.6 3 1.4 3h17.2c.8 0 1.4.6 1.4 1.4v1.2c0 .8-.6 1.4-1.4 1.4H1.4C.6 7 0 6.4 0 5.6V4.4zM0 10.8c0-.8.6-1.4 1.4-1.4h17.2c.8 0 1.4.6 1.4 1.4v1.2c0 .8-.6 1.4-1.4 1.4H1.4c-.8 0-1.4-.6-1.4-1.4v-1.2zm0 6.4c0-.8.6-1.4 1.4-1.4h17.2c.8 0 1.4.6 1.4 1.4v1.2c0 .8-.6 1.4-1.4 1.4H1.4c-.8 0-1.4-.6-1.4-1.4v-1.2z"
                        />
                    </svg>
                </button>
            </div>
            <div
                class="w-full block flex-grow lg:flex lg:items-center lg:w-auto"
            >
                <div class="text-sm lg:flex-grow">
                    <Link
                        href="/about"
                        class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4"
                    >
                        About The Founders
                    </Link>
                    <Link
                        href="/FAQ"
                        class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4"
                    >
                        Our Mission
                    </Link>
                    <Link
                        href="/gallery"
                        class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300"
                    >
                        Past Campaigns
                    </Link>
                </div>
            </div>
        </nav>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<script></script>
