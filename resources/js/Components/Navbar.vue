<script setup>
import { ref } from "vue";
import { usePage, Link } from "@inertiajs/vue3";
import { ChevronDown, Menu, X } from "lucide-vue-next";

const page = usePage();

const mobileMenu = ref(false);
</script>

<template>
    <nav
        class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-100 shadow-sm"
    >
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-center h-[78px]">
                <!-- LOGO -->
                <Link href="/" class="flex items-center gap-3 group">
                    <img
                        :src="'/images/logo.png'"
                        class="h-11 w-11 object-contain transition duration-300 group-hover:scale-105"
                    />

                    <div class="leading-tight">
                        <h1 class="font-black text-gray-800 text-lg">
                            SMP Pangudi Luhur Kalibawang
                        </h1>

                        <p class="text-xs text-gray-500 tracking-wide">
                            Menjadi Diri dalam AnugerahNya ─ Aku cerdas
                        </p>
                    </div>
                </Link>

                <!-- DESKTOP MENU -->
                <div class="hidden lg:flex items-center gap-8">
                    <Link
                        href="/"
                        class="text-gray-700 hover:text-blue-600 font-medium transition duration-300"
                    >
                        Home
                    </Link>

                    <!-- PROFIL -->
                    <div class="relative group">
                        <button
                            class="flex items-center gap-1 py-2 text-gray-700 hover:text-blue-600 font-medium transition duration-300"
                        >
                            Profil

                            <ChevronDown
                                class="w-4 h-4 transition duration-300 group-hover:rotate-180"
                            />
                        </button>

                        <!-- DROPDOWN -->
                        <div
                            class="absolute left-0 top-full pt-3 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300"
                        >
                            <div
                                class="w-72 rounded-2xl bg-white border border-gray-100 shadow-[0_10px_40px_rgba(0,0,0,0.08)] overflow-hidden p-2"
                            >
                                <!-- TENTANG -->
                                <Link
                                    href="/profil/tentang"
                                    class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-50 transition"
                                >
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-blue-50 flex items-center justify-center"
                                    >
                                        🏫
                                    </div>

                                    <div>
                                        <div class="font-bold text-gray-800">
                                            Tentang Sekolah
                                        </div>

                                        <div class="text-xs text-gray-400">
                                            Profil & informasi sekolah
                                        </div>
                                    </div>
                                </Link>

                                <!-- VISI MISI -->
                                <Link
                                    href="/profil/visi-misi"
                                    class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-50 transition"
                                >
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-violet-50 flex items-center justify-center"
                                    >
                                        🎯
                                    </div>

                                    <div>
                                        <div class="font-bold text-gray-800">
                                            Visi & Misi
                                        </div>

                                        <div class="text-xs text-gray-400">
                                            Arah & tujuan pendidikan
                                        </div>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </div>

                    <Link
                        href="/guru"
                        class="text-gray-700 hover:text-blue-600 font-medium transition duration-300"
                    >
                        Guru
                    </Link>

                    <Link
                        href="/blog"
                        class="text-gray-700 hover:text-blue-600 font-medium transition duration-300"
                    >
                        Blog
                    </Link>

                    <Link
                        href="/pengumuman"
                        class="text-gray-700 hover:text-blue-600 font-medium transition duration-300"
                    >
                        Pengumuman
                    </Link>

                    <Link
                        href="/agenda"
                        class="text-gray-700 hover:text-blue-600 font-medium transition duration-300"
                    >
                        Agenda
                    </Link>

                    <!-- MEDIA -->
                    <div class="relative group">
                        <button
                            class="flex items-center gap-2 text-gray-700 hover:text-blue-600 font-medium transition duration-300"
                        >
                            Media

                            <svg
                                class="w-4 h-4 transition duration-300 group-hover:rotate-180"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </button>

                        <!-- DROPDOWN -->
                        <div
                            class="absolute left-0 top-full pt-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50"
                        >
                            <div
                                class="w-56 rounded-3xl bg-white border border-gray-100 shadow-[0_20px_60px_rgba(0,0,0,0.12)] overflow-hidden p-3"
                            >
                                <Link
                                    href="/galleries"
                                    class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-50 transition"
                                >
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-pink-50 flex items-center justify-center"
                                    >
                                        🖼️
                                    </div>

                                    <div>
                                        <div class="font-bold text-gray-800">
                                            Galeri
                                        </div>

                                        <div class="text-xs text-gray-400">
                                            Dokumentasi kegiatan sekolah
                                        </div>
                                    </div>
                                </Link>

                                <Link
                                    href="/download"
                                    class="flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-slate-50 transition"
                                >
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-blue-50 flex items-center justify-center"
                                    >
                                        📄
                                    </div>

                                    <div>
                                        <div class="font-bold text-gray-800">
                                            Download
                                        </div>

                                        <div class="text-xs text-gray-400">
                                            Dokumen & file sekolah
                                        </div>
                                    </div>
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <Link
                        href="/hubungi-kami"
                        class="px-5 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300"
                    >
                        Hubungi Kami
                    </Link>
                </div>

                <!-- MOBILE BUTTON -->
                <button
                    @click="mobileMenu = !mobileMenu"
                    class="lg:hidden w-11 h-11 rounded-xl bg-gray-100 flex items-center justify-center text-gray-700"
                >
                    <Menu v-if="!mobileMenu" class="w-5 h-5" />

                    <X v-else class="w-5 h-5" />
                </button>
            </div>

            <!-- MOBILE MENU -->
            <transition
                enter-active-class="transition duration-300 ease-out"
                enter-from-class="opacity-0 -translate-y-2"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition duration-200 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-2"
            >
                <div
                    v-if="mobileMenu"
                    class="lg:hidden border-t border-gray-100 py-4"
                >
                    <div class="flex flex-col gap-1">
                        <Link
                            href="/"
                            class="px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
                        >
                            Home
                        </Link>

                        <!-- PROFIL MOBILE -->
                        <div
                            class="px-4 pt-3 pb-2 text-xs font-bold uppercase tracking-wider text-gray-400"
                        >
                            Profil
                        </div>

                        <Link
                            href="/profil/tentang"
                            class="px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
                        >
                            Tentang Sekolah
                        </Link>

                        <Link
                            href="/profil/visi-misi"
                            class="px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
                        >
                            Visi & Misi
                        </Link>

                        <Link
                            href="/guru"
                            class="px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
                        >
                            Guru
                        </Link>

                        <Link
                            href="/siswa"
                            class="px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
                        >
                            Siswa
                        </Link>

                        <Link
                            href="/blog"
                            class="px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
                        >
                            Blog
                        </Link>

                        <Link
                            href="/pengumuman"
                            class="px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
                        >
                            Pengumuman
                        </Link>

                        <Link
                            href="/agenda"
                            class="px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
                        >
                            Agenda
                        </Link>

                        <Link
                            href="/hubungi-kami"
                            class="mt-3 px-5 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-center font-semibold shadow-lg"
                        >
                            Hubungi Kami
                        </Link>
                    </div>
                </div>
            </transition>
        </div>
    </nav>
</template>
