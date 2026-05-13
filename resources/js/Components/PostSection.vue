<script setup>
import { Newspaper } from "lucide-vue-next";

defineProps({
    posts: Array,
});
</script>

<template>
    <div>
        <!-- HEADER -->
        <div class="flex items-center gap-2 mb-6">
            <Newspaper class="w-6 h-6 text-blue-500" />
            <h2 class="text-2xl font-bold text-gray-800">Berita Terkini</h2>
        </div>

        <!-- GRID -->
        <div class="grid md:grid-cols-3 gap-6">
            <div
                v-for="post in posts"
                :key="post.id"
                class="bg-white shadow rounded-xl overflow-hidden hover:shadow-lg transition"
            >
                <!-- THUMBNAIL -->
                <img
                    :src="post.thumbnail ?? '/images/default.png'"
                    class="w-full h-48 object-cover"
                />

                <!-- CONTENT -->
                <div class="p-4 flex flex-col gap-2">
                    <!-- JUDUL -->
                    <h3 class="font-bold text-lg text-gray-800 line-clamp-2">
                        {{ post.title }}
                    </h3>

                    <!-- META -->
                    <p class="text-xs text-gray-500">
                        Oleh: {{ post.author ?? "Admin" }} |
                        {{ post.date ?? "-" }}
                    </p>

                    <!-- HIGHLIGHT -->
                    <p class="text-sm text-gray-600 line-clamp-3 mt-1">
                        {{ post.excerpt }}
                    </p>

                    <!-- READ MORE -->
                    <a
                        :href="`/blog/${post.slug}`"
                        class="text-blue-500 text-sm font-semibold mt-2 hover:underline"
                    >
                        Baca Selengkapnya →
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
