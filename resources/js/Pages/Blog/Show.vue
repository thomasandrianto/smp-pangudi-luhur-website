<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";

import { Link, useForm } from "@inertiajs/vue3";

import {
    CalendarDays,
    Eye,
    Search,
    Folder,
    TrendingUp,
    Layers3,
    User,
    MessageCircle,
    Send,
    CornerDownRight,
} from "lucide-vue-next";

const props = defineProps({
    post: Object,

    comments: {
        type: Array,
        default: () => [],
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

// COMMENT FORM
const form = useForm({
    name: "",
    email: "",
    content: "",
    parent_id: null,
});

// REPLY
const replyTo = (commentId) => {
    form.parent_id = commentId;

    window.scrollTo({
        top: document.body.scrollHeight,
        behavior: "smooth",
    });
};

const cancelReply = () => {
    form.parent_id = null;
};
</script>

<template>
    <MainLayout>
        <!-- HERO -->
        <section class="relative h-[340px] overflow-hidden">
            <img
                :src="post.thumbnail"
                class="absolute inset-0 w-full h-full object-cover"
            />

            <div
                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-black/30"
            ></div>

            <div
                class="relative z-10 h-full max-w-7xl mx-auto px-6 flex flex-col justify-end pb-14"
            >
                <!-- CATEGORY -->
                <div
                    class="inline-flex items-center w-fit px-4 py-2 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-white text-sm font-semibold mb-6"
                >
                    {{ post.category }}
                </div>

                <!-- TITLE -->
                <h1
                    class="text-4xl md:text-5xl font-black text-white max-w-4xl leading-tight"
                >
                    {{ post.title }}
                </h1>

                <!-- META -->
                <div
                    class="flex flex-wrap items-center gap-6 mt-6 text-white/80"
                >
                    <div class="flex items-center gap-2">
                        <CalendarDays class="w-4 h-4" />
                        {{ post.date }}
                    </div>

                    <div class="flex items-center gap-2">
                        <Eye class="w-4 h-4" />
                        {{ post.views }} views
                    </div>

                    <div class="flex items-center gap-2">
                        <User class="w-4 h-4" />
                        {{ post.author }}
                    </div>
                </div>
            </div>
        </section>

        <!-- CONTENT -->
        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-12 gap-10">
                <!-- ARTICLE -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- ARTICLE -->
                    <article
                        class="bg-white rounded-[32px] border border-gray-100 shadow-sm overflow-hidden"
                    >
                        <!-- CONTENT -->
                        <div
                            class="p-8 md:p-12 lg:p-14 prose prose-lg max-w-none prose-headings:font-black prose-headings:text-gray-800 prose-p:text-gray-600 prose-p:leading-8 prose-li:text-gray-600 prose-strong:text-gray-800 prose-a:text-blue-600 prose-img:rounded-2xl prose-img:shadow-lg prose-ul:list-disc prose-ul:pl-6 prose-ol:list-decimal prose-ol:pl-6 prose-li:marker:text-blue-500"
                            v-html="post.content"
                        ></div>
                    </article>

                    <!-- COMMENTS -->
                    <div
                        class="bg-white rounded-[32px] border border-gray-100 shadow-sm p-8 md:p-10"
                    >
                        <!-- HEADER -->
                        <div
                            class="flex flex-wrap items-center justify-between gap-4 mb-10"
                        >
                            <div>
                                <h2 class="text-3xl font-black text-gray-800">
                                    Komentar
                                </h2>

                                <p class="text-gray-500 mt-2">
                                    Diskusi & tanggapan pembaca
                                </p>
                            </div>

                            <div
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-blue-50 text-blue-700 font-bold"
                            >
                                <MessageCircle class="w-5 h-5" />

                                {{ comments.length }}
                            </div>
                        </div>

                        <!-- COMMENT LIST -->
                        <div v-if="comments.length" class="space-y-6">
                            <!-- COMMENT -->
                            <div
                                v-for="comment in comments"
                                :key="comment.id"
                                class="rounded-[28px] border border-slate-100 bg-slate-50 p-7"
                            >
                                <div class="flex gap-5">
                                    <!-- AVATAR -->
                                    <div
                                        class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center font-black text-lg shrink-0 shadow-lg"
                                    >
                                        {{
                                            comment.name.charAt(0).toUpperCase()
                                        }}
                                    </div>

                                    <!-- CONTENT -->
                                    <div class="flex-1">
                                        <!-- HEADER -->
                                        <div
                                            class="flex flex-wrap items-center gap-3"
                                        >
                                            <h3
                                                class="font-black text-gray-800"
                                            >
                                                {{ comment.name }}
                                            </h3>

                                            <span class="text-sm text-gray-400">
                                                {{ comment.created_at }}
                                            </span>
                                        </div>

                                        <!-- TEXT -->
                                        <p class="mt-4 text-gray-600 leading-8">
                                            {{ comment.content }}
                                        </p>

                                        <!-- REPLY BUTTON -->
                                        <button
                                            @click="replyTo(comment.id)"
                                            class="inline-flex items-center gap-2 mt-5 text-sm font-semibold text-blue-600 hover:text-blue-700 transition"
                                        >
                                            <CornerDownRight class="w-4 h-4" />

                                            Balas
                                        </button>

                                        <!-- REPLIES -->
                                        <div
                                            v-if="
                                                comment.replies &&
                                                comment.replies.length
                                            "
                                            class="mt-8 space-y-5 border-l-2 border-blue-100 pl-6"
                                        >
                                            <div
                                                v-for="reply in comment.replies"
                                                :key="reply.id"
                                                class="rounded-3xl bg-white border border-slate-100 p-5"
                                            >
                                                <div class="flex gap-4">
                                                    <!-- AVATAR -->
                                                    <div
                                                        class="w-12 h-12 rounded-2xl bg-gradient-to-br from-violet-500 to-purple-600 text-white flex items-center justify-center font-black shrink-0"
                                                    >
                                                        {{
                                                            reply.name
                                                                .charAt(0)
                                                                .toUpperCase()
                                                        }}
                                                    </div>

                                                    <!-- CONTENT -->
                                                    <div class="flex-1">
                                                        <div
                                                            class="flex flex-wrap items-center gap-3"
                                                        >
                                                            <h4
                                                                class="font-black text-gray-800"
                                                            >
                                                                {{ reply.name }}
                                                            </h4>

                                                            <span
                                                                class="text-xs text-gray-400"
                                                            >
                                                                {{
                                                                    reply.created_at
                                                                }}
                                                            </span>
                                                        </div>

                                                        <p
                                                            class="mt-3 text-gray-600 leading-7"
                                                        >
                                                            {{ reply.content }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- EMPTY -->
                        <div
                            v-else
                            class="text-center py-16 border border-dashed border-gray-200 rounded-[28px]"
                        >
                            <div
                                class="w-20 h-20 rounded-3xl bg-slate-100 mx-auto flex items-center justify-center"
                            >
                                <MessageCircle
                                    class="w-10 h-10 text-gray-400"
                                />
                            </div>

                            <h3 class="text-2xl font-black text-gray-800 mt-6">
                                Belum Ada Komentar
                            </h3>

                            <p class="text-gray-500 mt-3">
                                Jadilah yang pertama memberikan komentar.
                            </p>
                        </div>

                        <!-- COMMENT FORM -->
                        <div class="mt-14 border-t border-gray-100 pt-10">
                            <div
                                class="flex items-center justify-between flex-wrap gap-4 mb-8"
                            >
                                <div>
                                    <h3
                                        class="text-3xl font-black text-gray-800"
                                    >
                                        Tinggalkan Komentar
                                    </h3>

                                    <p class="text-gray-500 mt-2">
                                        Komentar akan tampil setelah disetujui
                                        admin.
                                    </p>
                                </div>

                                <!-- REPLY BADGE -->
                                <div
                                    v-if="form.parent_id"
                                    class="inline-flex items-center gap-3 px-4 py-3 rounded-2xl bg-blue-50 text-blue-700 text-sm font-semibold"
                                >
                                    Membalas komentar

                                    <button
                                        @click="cancelReply"
                                        class="text-red-500 hover:text-red-600"
                                    >
                                        ✕
                                    </button>
                                </div>
                            </div>

                            <!-- FORM -->
                            <form
                                @submit.prevent="
                                    form.post(`/blog/${post.slug}/comment`, {
                                        preserveScroll: true,

                                        onSuccess: () => {
                                            form.reset();
                                        },
                                    })
                                "
                                class="space-y-5"
                            >
                                <!-- NAME -->
                                <div>
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        placeholder="Nama"
                                        class="w-full h-14 px-5 rounded-2xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />

                                    <p
                                        v-if="form.errors.name"
                                        class="text-red-500 text-sm mt-2"
                                    >
                                        {{ form.errors.name }}
                                    </p>
                                </div>

                                <!-- EMAIL -->
                                <div>
                                    <input
                                        v-model="form.email"
                                        type="email"
                                        placeholder="Email"
                                        class="w-full h-14 px-5 rounded-2xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />

                                    <p
                                        v-if="form.errors.email"
                                        class="text-red-500 text-sm mt-2"
                                    >
                                        {{ form.errors.email }}
                                    </p>
                                </div>

                                <!-- CONTENT -->
                                <div>
                                    <textarea
                                        v-model="form.content"
                                        rows="6"
                                        placeholder="Tulis komentar..."
                                        class="w-full px-5 py-4 rounded-2xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    ></textarea>

                                    <p
                                        v-if="form.errors.content"
                                        class="text-red-500 text-sm mt-2"
                                    >
                                        {{ form.errors.content }}
                                    </p>
                                </div>

                                <!-- BUTTON -->
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="inline-flex items-center gap-3 px-8 h-14 rounded-2xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition-all duration-300 disabled:opacity-50"
                                >
                                    <Send class="w-5 h-5" />

                                    {{
                                        form.processing
                                            ? "Mengirim..."
                                            : "Kirim Komentar"
                                    }}
                                </button>
                            </form>
                        </div>
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
                            <div
                                v-for="category in categories"
                                :key="category.id"
                                class="inline-flex items-center gap-2 px-4 py-3 rounded-2xl bg-slate-100 text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-all duration-300 cursor-pointer font-medium text-sm"
                            >
                                <Folder class="w-4 h-4" />

                                {{ category.name }}

                                <span
                                    class="px-2 py-1 rounded-full bg-white text-xs"
                                >
                                    {{ category.posts_count }}
                                </span>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </MainLayout>
</template>
