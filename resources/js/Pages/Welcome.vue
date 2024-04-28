<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Header from "@/Components/Header.vue";
import Sources from "@/Components/Sources.vue";
import ItemCard from "@/Components/ItemCard.vue";

const props = defineProps<{
    sources: Array;
    items: Array;
}>();

const posts = [
    {
        id: 1,
        title: 'Boost your conversion rate',
        href: '#',
        description:
            'Illo sint voluptas. Error voluptates culpa eligendi. Hic vel totam vitae illo. Non aliquid explicabo necessitatibus unde. Sed exercitationem placeat consectetur nulla deserunt vel iusto corrupti dicta laboris incididunt.',
        imageUrl:
            'https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3603&q=80',
        date: 'Mar 16, 2020',
        datetime: '2020-03-16',
        category: { title: 'Marketing', href: '#' },
        author: {
            name: 'Michael Foster',
            role: 'Co-Founder / CTO',
            href: '#',
            imageUrl:
                'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
    },
    // More posts...
]
</script>

<template>
    <Head title="Welcome" />
    <Header
        :sources="props.sources.length"
        :items="props.items.length"
    />
    <Sources
        :sources="props.sources"
    />

    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:max-w-4xl">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Latest Items
                </h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">
                    Catch up on the latest items that have been aggregated from across the web.
                </p>
                <div class="mx-auto mt-16 grid max-w-2xl auto-rows-fr grid-cols-1 gap-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                    <template v-for="item in props.items" :key="item.id">
                        <ItemCard :item="item" />
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>
