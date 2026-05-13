<script setup>
defineProps({
    testimonials: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <section class="relative overflow-hidden">
        <!-- BG -->
        <div
            class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-indigo-50 rounded-[40px]"
        ></div>

        <div class="relative max-w-7xl mx-auto px-6 py-20">
            <!-- HEADER -->
            <div class="text-center mb-14">
                <p
                    class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-bold"
                >
                    TESTIMONI
                </p>

                <h2 class="mt-6 text-4xl lg:text-5xl font-black text-gray-800">
                    Apa Kata Mereka?
                </h2>

                <p
                    class="mt-5 text-gray-500 max-w-2xl mx-auto leading-8 text-lg"
                >
                    Pengalaman dan kesan dari siswa, orang tua, maupun alumni
                    tentang sekolah kami.
                </p>
            </div>

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                <div
                    v-for="item in testimonials"
                    :key="item.id"
                    class="group relative bg-white rounded-[32px] p-8 border border-gray-100 shadow-sm hover:shadow-[0_20px_60px_rgba(0,0,0,0.08)] transition-all duration-500 hover:-translate-y-2 overflow-hidden"
                >
                    <!-- QUOTE -->
                    <div
                        class="absolute -top-5 -right-2 text-[120px] font-black text-blue-50 leading-none"
                    >
                        "
                    </div>

                    <!-- CONTENT -->
                    <p
                        class="relative z-10 text-gray-600 leading-8 text-[15px]"
                    >
                        {{ item.content }}
                    </p>

                    <!-- FOOTER -->
                    <div class="relative z-10 mt-8 flex items-center gap-4">
                        <!-- AVATAR -->
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 text-white flex items-center justify-center font-black text-lg shadow-lg"
                        >
                            {{ item.initial }}
                        </div>

                        <!-- INFO -->
                        <div>
                            <h3 class="font-black text-gray-800">
                                {{ item.name }}
                            </h3>

                            <p class="text-sm text-gray-400">Alumni</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- EMPTY -->
            <div
                v-if="testimonials.length === 0"
                class="bg-white rounded-3xl p-16 text-center border border-gray-100"
            >
                <h3 class="text-2xl font-black text-gray-800">
                    Belum ada testimoni
                </h3>

                <p class="mt-3 text-gray-500">Testimoni akan tampil di sini.</p>
            </div>
        </div>
    </section>
</template>
