<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";

defineProps({
    page: Object,
});
</script>

<template>
    <MainLayout>
        <section
            class="relative overflow-hidden bg-gradient-to-b from-slate-50 via-white to-slate-50 min-h-screen py-20"
        >
            <!-- BACKGROUND GLOW -->
            <div
                class="absolute top-0 left-0 w-[400px] h-[400px] bg-blue-100/40 blur-3xl rounded-full"
            ></div>

            <div
                class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-indigo-100/40 blur-3xl rounded-full"
            ></div>

            <div class="relative max-w-5xl mx-auto px-6">
                <!-- BREADCRUMB -->
                <div class="mb-6 text-sm text-gray-500 flex items-center gap-2">
                    <span>Home</span>

                    <span>/</span>

                    <span class="text-blue-600 font-medium">
                        {{ page.title }}
                    </span>
                </div>

                <!-- HEADER -->
                <div class="mb-14">
                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-800 leading-tight"
                    >
                        {{ page.title }}
                    </h1>

                    <div
                        class="mt-6 w-32 h-1 rounded-full bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"
                    ></div>
                </div>

                <!-- CONTENT CARD -->
                <div
                    class="relative bg-white/90 backdrop-blur rounded-[2rem] border border-white shadow-[0_20px_80px_rgba(0,0,0,0.08)] overflow-hidden"
                >
                    <!-- TOP ACCENT -->
                    <div
                        class="h-2 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"
                    ></div>

                    <!-- CONTENT -->
                    <div
                        class="p-8 md:p-12 lg:p-16 prose prose-lg prose-slate max-w-none prose-headings:font-black prose-headings:text-gray-800 prose-headings:tracking-tight prose-headings:scroll-mt-32 prose-h1:text-5xl prose-h1:mb-8 prose-h2:text-3xl prose-h2:mt-14 prose-h2:mb-6 prose-h2:border-b prose-h2:border-gray-200 prose-h2:pb-3 prose-h3:text-2xl prose-h3:mt-10 prose-h3:mb-4 prose-p:text-gray-600 prose-p:leading-8 prose-p:mb-6 prose-strong:text-gray-800 prose-strong:font-bold prose-a:text-blue-600 prose-a:font-semibold prose-a:no-underline hover:prose-a:text-blue-700 prose-blockquote:border-l-4 prose-blockquote:border-blue-500 prose-blockquote:bg-blue-50/50 prose-blockquote:rounded-r-2xl prose-blockquote:px-6 prose-blockquote:py-4 prose-blockquote:italic prose-blockquote:text-gray-700 prose-ul:list-disc prose-ul:pl-6 prose-ul:space-y-2 prose-ol:list-decimal prose-ol:pl-6 prose-ol:space-y-2 prose-li:text-gray-600 prose-li:leading-8 prose-li:marker:text-blue-500 prose-img:rounded-2xl prose-img:shadow-xl prose-img:border prose-img:border-gray-100 prose-hr:my-12 prose-hr:border-gray-200 prose-table:w-full prose-table:border-collapse prose-th:bg-gray-100 prose-th:text-gray-800 prose-th:font-bold prose-th:p-4 prose-th:border prose-th:border-gray-200 prose-td:p-4 prose-td:border prose-td:border-gray-200 prose-code:text-pink-600 prose-code:bg-pink-50 prose-code:px-2 prose-code:py-1 prose-code:rounded-md prose-code:before:content-none prose-code:after:content-none prose-pre:bg-gray-900 prose-pre:border prose-pre:border-gray-800 prose-pre:rounded-2xl prose-pre:shadow-2xl"
                        v-html="page.content"
                    ></div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
