<script setup lang="ts">
const props = defineProps<{
    sources: Array;
}>();
</script>

<template>
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 items-center gap-x-8 gap-y-16 lg:grid-cols-2">
                <div class="mx-auto w-full max-w-xl lg:mx-0">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">
                        Some of the sources currently being aggregated
                    </h2>
                    <p class="mt-6 text-lg leading-8 text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et, egestas tempus tellus etiam sed. Quam a scelerisque amet ullamcorper eu enim et fermentum, augue.</p>
                    <div class="mt-8 flex items-center gap-x-6">
                        <a href="#" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Register your source
                        </a>
                    </div>
                </div>
                <div class="mx-auto grid w-full max-w-xl grid-cols-2 items-center gap-y-12 sm:gap-y-14 lg:mx-0 lg:max-w-none lg:pl-8">
                    <img
                        v-for="source in props.sources.slice(0,3)"
                        class="max-h-36 w-full object-contain object-left"
                        :src="source.logo"
                        :alt="source.name"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

