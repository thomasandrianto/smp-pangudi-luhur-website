<script setup>
</script>

<template>
    <div class="grid md:grid-cols-2 gap-10 items-center">
        <!-- FOTO -->
        <div class="flex justify-center">
            <img
                :src="'/images/b7a77f05a30306c099445ccc6d984052.png'"
                class="w-[300px] h-[350px] object-cover rounded-xl shadow-lg"
            />
        </div>

        <!-- TEXT -->
        <div>
            <h2 class="text-3xl font-bold mb-4 text-gray-800">
                Sambutan Kepala Sekolah
            </h2>

            <!-- garis aksen -->
            <div class="w-16 h-1 bg-blue-500 mb-4"></div>

            <p class="text-gray-600 leading-relaxed text-justify">
                Selamat datang di website
                <span class="font-semibold">
                    SMP Pangudi Luhur 1 Kalibawang Kulonprogo </span
                >. Semoga website ini menjadi media interaksi yang bermanfaat
                bagi kita semua.
            </p>

            <!-- nama -->
            <div class="mt-6">
                <p class="font-bold text-lg text-gray-800">
                    Br. Yohanes Sinu, Fic
                </p>
                <p class="text-sm text-gray-500">Kepala Sekolah</p>
            </div>
        </div>
    </div>
    <div
        class="h-1 bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 my-10"
    ></div>
</template>
