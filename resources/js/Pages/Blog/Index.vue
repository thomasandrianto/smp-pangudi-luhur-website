<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";

import {
    CalendarDays,
    Eye,
    Search,
    Folder,
    ArrowRight,
    TrendingUp,
    Layers3,
} from "lucide-vue-next";

defineProps({
    posts: {
        type: Object,
        default: () => ({
            data: [],
            links: [],
        }),
    },

    popularPosts: {
        type: Array,
        default: () => [],
    },

    categories: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <MainLayout>
        <!-- HERO -->
        <section class="relative h-[260px] overflow-hidden">
            <!-- IMAGE -->
            <img
                :src="'/images/7851df18b123da264cc16112d769ab6a.png'"
                class="absolute inset-0 w-full h-full object-cover"
            />

            <!-- OVERLAY -->
            <div
                class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"
            ></div>

            <!-- CONTENT -->
            <div
                class="relative z-10 h-full max-w-7xl mx-auto px-6 flex flex-col justify-center"
            >
                <p class="text-blue-300 font-medium mb-4">Home / Blog</p>

                <h1 class="text-5xl md:text-6xl font-black text-white">
                    Blog Sekolah
                </h1>

                <p class="text-gray-200 mt-5 max-w-2xl text-lg leading-8">
                    Berita, kegiatan, prestasi, dan berbagai informasi terbaru
                    dari sekolah kami.
                </p>
            </div>
        </section>

        <!-- CONTENT -->
        <section class="py-14 bg-slate-50">
            <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-12 gap-10">
                <!-- LEFT -->
                <div class="lg:col-span-8 space-y-6">
                    <!-- POSTS -->
                    <article
                        v-for="post in posts.data"
                        :key="post.id"
                        class="group overflow-hidden rounded-[28px] bg-white border border-gray-100 shadow-sm hover:shadow-[0_20px_60px_rgba(0,0,0,0.08)] transition-all duration-500"
                    >
                        <!-- IMAGE -->
                        <div class="relative overflow-hidden">
                            <img
                                :src="post.thumbnail"
                                class="w-full h-[180px] md:h-[220px] object-cover group-hover:scale-105 transition duration-700"
                            />

                            <!-- OVERLAY -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/5 to-transparent"
                            ></div>

                            <!-- CATEGORY -->
                            <div class="absolute top-4 left-4">
                                <div
                                    class="px-4 py-2 rounded-full bg-white/90 backdrop-blur-md text-xs font-bold tracking-wide uppercase text-gray-700 shadow-lg"
                                >
                                    {{ post.category }}
                                </div>
                            </div>
                        </div>

                        <!-- CONTENT -->
                        <div class="p-6 lg:p-7">
                            <!-- META -->
                            <div
                                class="flex flex-wrap items-center gap-5 text-sm text-gray-400 mb-4"
                            >
                                <div class="flex items-center gap-2">
                                    <CalendarDays class="w-4 h-4" />

                                    {{ post.date }}
                                </div>

                                <div class="flex items-center gap-2">
                                    <Eye class="w-4 h-4" />

                                    {{ post.views }} views
                                </div>
                            </div>

                            <!-- TITLE -->
                            <h2
                                class="text-xl lg:text-2xl font-black text-gray-800 leading-snug group-hover:text-blue-600 transition"
                            >
                                {{ post.title }}
                            </h2>

                            <!-- EXCERPT -->
                            <p class="text-gray-600 leading-7 mt-4 text-[15px]">
                                {{ post.excerpt }}
                            </p>

                            <!-- BUTTON -->
                            <div class="mt-6">
                                <Link
                                    :href="`/blog/${post.slug}`"
                                    class="inline-flex items-center gap-2 text-blue-600 font-bold hover:text-blue-700 transition"
                                >
                                    Baca Selengkapnya

                                    <ArrowRight
                                        class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                                    />
                                </Link>
                            </div>
                        </div>
                    </article>

                    <!-- EMPTY -->
                    <div
                        v-if="posts.data.length === 0"
                        class="bg-white rounded-3xl p-16 text-center border border-gray-100"
                    >
                        <h3 class="text-2xl font-black text-gray-800">
                            Belum ada berita
                        </h3>

                        <p class="mt-3 text-gray-500">
                            Berita sekolah akan tampil di sini.
                        </p>
                    </div>

                    <!-- PAGINATION -->
                    <div
                        v-if="posts.links && posts.links.length"
                        class="flex flex-wrap justify-center gap-3 pt-8"
                    >
                        <template
                            v-for="(link, index) in posts.links"
                            :key="index"
                        >
                            <!-- ACTIVE -->
                            <Link
                                v-if="link && link.url"
                                :href="link.url"
                                v-html="link.label"
                                class="min-w-[44px] h-11 px-4 rounded-2xl border flex items-center justify-center text-sm font-semibold transition-all duration-300"
                                :class="
                                    link.active
                                        ? 'bg-blue-600 text-white border-blue-600 shadow-lg shadow-blue-200'
                                        : 'bg-white text-gray-700 border-gray-200 hover:bg-blue-50 hover:border-blue-300'
                                "
                            />

                            <!-- DISABLED -->
                            <span
                                v-else
                                v-html="link?.label || '-'"
                                class="min-w-[44px] h-11 px-4 rounded-2xl border border-gray-100 bg-gray-100 text-gray-400 flex items-center justify-center text-sm"
                            ></span>
                        </template>
                    </div>
                </div>

                <!-- SIDEBAR -->
                <aside class="lg:col-span-4 space-y-8">
                    <!-- SEARCH -->
                    <div
                        class="bg-white rounded-[28px] p-7 border border-gray-100 shadow-sm"
                    >
                        <h3 class="text-xl font-black text-gray-800 mb-5">
                            Cari Berita
                        </h3>

                        <div class="relative">
                            <Search
                                class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
                            />

                            <input
                                type="text"
                                placeholder="Cari berita..."
                                class="w-full h-13 pl-14 pr-5 rounded-2xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                        </div>
                    </div>

                    <!-- POPULAR -->
                    <div
                        class="bg-white rounded-[28px] p-7 border border-gray-100 shadow-sm"
                    >
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-black text-gray-800">
                                Berita Terpopuler
                            </h3>

                            <div
                                class="w-10 h-10 rounded-2xl bg-blue-50 flex items-center justify-center"
                            >
                                <TrendingUp class="w-5 h-5 text-blue-600" />
                            </div>
                        </div>

                        <div class="space-y-5">
                            <Link
                                v-for="item in popularPosts"
                                :key="item.id"
                                :href="`/blog/${item.slug}`"
                                class="flex gap-4 group"
                            >
                                <img
                                    :src="item.thumbnail"
                                    class="w-20 h-20 rounded-2xl object-cover"
                                />

                                <div class="flex-1">
                                    <h4
                                        class="font-bold text-gray-800 leading-snug text-sm group-hover:text-blue-600 transition"
                                    >
                                        {{ item.title }}
                                    </h4>

                                    <p class="text-xs text-gray-400 mt-2">
                                        {{ item.date }}
                                    </p>
                                </div>
                            </Link>
                        </div>
                    </div>

                    <!-- CATEGORY -->
                    <div
                        class="bg-white rounded-[28px] p-7 border border-gray-100 shadow-sm"
                    >
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-black text-gray-800">
                                Kategori
                            </h3>

                            <div
                                class="w-10 h-10 rounded-2xl bg-violet-50 flex items-center justify-center"
                            >
                                <Layers3 class="w-5 h-5 text-violet-600" />
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <Link
                                v-for="category in categories"
                                :key="category.id"
                                :href="`/blog/category/${category.slug}`"
                                class="inline-flex items-center gap-2 px-4 py-3 rounded-2xl bg-slate-100 text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-all duration-300 cursor-pointer font-medium text-sm"
                            >
                                <Folder class="w-4 h-4" />

                                {{ category.name }}

                                <span
                                    class="px-2 py-1 rounded-full bg-white text-xs"
                                >
                                    {{ category.posts_count }}
                                </span>
                            </Link>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </MainLayout>
</template>
