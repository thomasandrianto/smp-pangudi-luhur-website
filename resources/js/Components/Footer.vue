<script setup>
import { usePage } from "@inertiajs/vue3";

import { Instagram, Youtube, LogIn, GraduationCap } from "lucide-vue-next";

const page = usePage();

const startYear = 2026;
const currentYear = new Date().getFullYear();

const yearDisplay =
    currentYear > startYear ? `${startYear}-${currentYear}` : `${startYear}`;
</script>

<template>
    <footer
        class="relative mt-16 overflow-hidden bg-gradient-to-br from-gray-900 via-slate-900 to-black text-white"
    >
        <!-- BG EFFECT -->
        <div
            class="absolute top-0 left-0 w-72 h-72 bg-blue-600/10 rounded-full blur-3xl"
        ></div>

        <div
            class="absolute bottom-0 right-0 w-72 h-72 bg-indigo-600/10 rounded-full blur-3xl"
        ></div>

        <!-- CONTENT -->
        <div
            class="relative max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 px-6 py-14"
        >
            <!-- KOLOM 1 -->
            <div>
                <div class="flex items-center gap-4 mb-5">
                    <img
                        :src="'/images/logo.png'"
                        class="h-14 w-14 object-contain"
                    />

                    <div>
                        <h2 class="font-black text-xl leading-tight">
                            {{ page.props.appName }}
                        </h2>

                        <p class="text-sm text-gray-400 mt-1">
                            Website Resmi Sekolah
                        </p>
                    </div>
                </div>

                <p class="text-sm leading-7 text-gray-300">
                    {{ page.props.school.address }}
                </p>

                <p class="text-sm mt-4 text-gray-300">
                    Telp:
                    {{ page.props.school.phone }}
                </p>

                <p class="text-sm mt-1 text-gray-300">
                    Email:
                    {{ page.props.school.email }}
                </p>
            </div>

            <!-- KOLOM 2 -->
            <div>
                <h2 class="font-black text-lg mb-5">Menu</h2>

                <div class="space-y-4">
                    <a
                        href="/dashboard-pl/login"
                        target="_blank"
                        class="flex items-center gap-3 text-gray-300 hover:text-white transition"
                    >
                        <LogIn class="w-5 h-5" />

                        Login Admin
                    </a>
                </div>
            </div>

            <!-- KOLOM 3 -->
            <div>
                <h2 class="font-black text-lg mb-5">Link</h2>

                <div class="space-y-4">
                    <a
                        href="https://ppdbf06.kliksekolah.com"
                        target="_blank"
                        class="flex items-start gap-3 text-gray-300 hover:text-white transition group"
                    >
                        <GraduationCap
                            class="w-5 h-5 mt-0.5 text-blue-400 group-hover:scale-110 transition"
                        />

                        <div>
                            <p class="font-semibold">PPDB Online</p>

                            <p class="text-sm text-gray-400">
                                Penerimaan Peserta Didik Baru
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- KOLOM 4 -->
            <div>
                <h2 class="font-black text-lg mb-5">Sosial Media</h2>

                <div class="space-y-4">
                    <a
                        :href="page.props.school.instagram"
                        target="_blank"
                        class="flex items-center gap-3 text-gray-300 hover:text-pink-400 transition"
                    >
                        <Instagram class="w-5 h-5" />

                        Instagram
                    </a>

                    <a
                        :href="page.props.school.youtube"
                        target="_blank"
                        class="flex items-center gap-3 text-gray-300 hover:text-red-400 transition"
                    >
                        <Youtube class="w-5 h-5" />

                        YouTube
                    </a>
                </div>
            </div>
        </div>

        <!-- COPYRIGHT -->
        <div
            class="relative border-t border-white/10 py-5 text-center text-sm text-gray-400"
        >
            © {{ yearDisplay }}
            {{ page.props.appName }}

            <span class="mx-2">•</span>

            All rights reserved.
        </div>
    </footer>
</template>
