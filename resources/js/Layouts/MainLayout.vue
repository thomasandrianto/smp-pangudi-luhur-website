<script setup>
import Navbar from "../Components/Navbar.vue";
import Footer from "../Components/Footer.vue";
</script>

<template>
    <div>
        <Navbar />

        <main class="max-w-6xl mx-auto p-6">
            <slot />
        </main>

        <Footer />
    </div>
</template>
