<script setup lang="ts">
import {onMounted, ref} from "vue";

const props = defineProps<{
    item: Object;
}>()

let link = ref(0);

// onMounted(() => {
//     link.value = window.dub.links.get({
//         key: props.item.dub.key,
//         domain: props.item.dub.domain,
//     });
// });

</script>

<template>
    <div class="mx-auto bg-white rounded-3xl shadow-xl">
        <div class="grid rounded-3xl max-w-[370px] shadow-sm bg-slate-100 flex-col">
            <img
                :src="item.image"
                class="rounded-t-3xl justify-center grid h-80 object-cover"
                :alt="item.title"
            />

            <div class="group p-6 grid z-10">
                <a
                    :href="item.short_link"
                    :title="item.title"
                    :aria-label="item.title"
                    class="group-hover:text-cyan-700 font-bold sm:text-2xl line-clamp-2"
                >
                    {{ item.title }}
                </a>
                <span class="text-slate-400 pt-2 font-semibold">
                    {{ item.source.name }}
                </span>
                <div class="h-28">
                    <span class="line-clamp-4 py-2 text-sm font-light leading-relaxed">
                        {{ item.description }}
                    </span>
                </div>
                <div class="grid-cols-2 flex group justify-between">
                    <div class="font-black flex flex-col">
                        <span class="text-yellow-500 text-xl">Views</span>
                        <span class="text-3xl flex gap-x-1 items-center group-hover:text-yellow-600">
                            {{ link.clicks ?? 0 }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
