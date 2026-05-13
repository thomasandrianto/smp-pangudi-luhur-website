<script setup>
import MainLayout from "../Layouts/MainLayout.vue";
import Hero from "../Components/Hero.vue";
import Headmaster from "../Components/Headmaster.vue";
import InfoSection from "../Components/InfoSection.vue";
import PostSection from "../Components/PostSection.vue";
import TestimonialSection from "../Components/TestimonialSection.vue";

defineProps({
    announcements: Array,
    events: Array,
    posts: Array,
    testimonials: Array,
});
</script>

<template>
    <MainLayout>
        <Hero />

        <div class="my-10">
            <Headmaster />
        </div>

        <div
            class="my-20 bg-gradient-to-b from-slate-50 to-white py-16 rounded-[40px]"
        >
            <InfoSection :announcements="announcements" :events="events" />
        </div>

        <div class="my-20">
            <TestimonialSection :testimonials="testimonials" />
        </div>

        <div class="my-10">
            <PostSection :posts="posts" />
        </div>
    </MainLayout>
</template>
