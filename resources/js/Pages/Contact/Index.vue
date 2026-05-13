<script setup>
import MainLayout from "../../Layouts/MainLayout.vue";
import { useForm, usePage } from "@inertiajs/vue3";

const page = usePage();

const form = useForm({
    name: "",
    email: "",
    phone: "",
    message: "",
});

const submit = () => {
    form.post("/hubungi-kami", {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <MainLayout>
        <!-- HERO -->
        <section class="relative h-[240px] overflow-hidden">
            <img
                :src="'/images/7851df18b123da264cc16112d769ab6a.png'"
                class="absolute inset-0 w-full h-full object-cover"
            />

            <div
                class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/60 to-black/50"
            ></div>

            <div
                class="relative z-10 h-full max-w-7xl mx-auto px-6 flex flex-col justify-center"
            >
                <p class="text-blue-200 font-medium mb-3">
                    Home / Hubungi Kami
                </p>

                <h1 class="text-5xl font-black text-white">Hubungi Kami</h1>

                <p class="text-gray-200 mt-4 max-w-2xl text-lg">
                    Kirim pertanyaan, kritik, saran, atau informasi lainnya
                    kepada pihak sekolah dengan mudah.
                </p>
            </div>
        </section>

        <!-- CONTENT -->
        <section class="py-16 bg-slate-50">
            <div class="max-w-4xl mx-auto px-6">
                <div
                    class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden"
                >
                    <!-- HEADER -->
                    <div class="p-8 border-b border-gray-100">
                        <h2 class="text-3xl font-black text-gray-800">
                            Form Hubungi Kami
                        </h2>

                        <p class="mt-3 text-gray-500 leading-7">
                            Silakan isi formulir berikut untuk menghubungi pihak
                            sekolah.
                        </p>
                    </div>

                    <!-- SUCCESS -->
                    <div
                        v-if="page.props.flash.success"
                        class="mx-8 mt-8 p-5 rounded-2xl bg-green-50 border border-green-200 text-green-700"
                    >
                        {{ page.props.flash.success }}
                    </div>

                    <!-- FORM -->
                    <form @submit.prevent="submit" class="p-8 space-y-6">
                        <!-- NAME -->
                        <div>
                            <label
                                class="block mb-2 font-semibold text-gray-700"
                            >
                                Nama Lengkap
                            </label>

                            <input
                                v-model="form.name"
                                type="text"
                                class="w-full h-14 px-5 rounded-2xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan nama lengkap"
                            />

                            <div
                                v-if="form.errors.name"
                                class="text-red-500 text-sm mt-2"
                            >
                                {{ form.errors.name }}
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div>
                            <label
                                class="block mb-2 font-semibold text-gray-700"
                            >
                                Email
                            </label>

                            <input
                                v-model="form.email"
                                type="email"
                                class="w-full h-14 px-5 rounded-2xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan email"
                            />

                            <div
                                v-if="form.errors.email"
                                class="text-red-500 text-sm mt-2"
                            >
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <!-- PHONE -->
                        <div>
                            <label
                                class="block mb-2 font-semibold text-gray-700"
                            >
                                Nomor HP
                            </label>

                            <input
                                v-model="form.phone"
                                type="text"
                                class="w-full h-14 px-5 rounded-2xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan nomor HP"
                            />
                        </div>

                        <!-- MESSAGE -->
                        <div>
                            <label
                                class="block mb-2 font-semibold text-gray-700"
                            >
                                Pesan
                            </label>

                            <textarea
                                v-model="form.message"
                                rows="6"
                                class="w-full px-5 py-4 rounded-2xl border border-gray-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Tulis pesan Anda..."
                            ></textarea>

                            <div
                                v-if="form.errors.message"
                                class="text-red-500 text-sm mt-2"
                            >
                                {{ form.errors.message }}
                            </div>
                        </div>

                        <!-- BUTTON -->
                        <div>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="w-full h-14 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold hover:scale-[1.01] transition-all duration-300 shadow-lg shadow-blue-200 disabled:opacity-50"
                            >
                                {{
                                    form.processing
                                        ? "Mengirim..."
                                        : "Kirim Pesan"
                                }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
