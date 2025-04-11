<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { MapMouseEvent } from 'maplibre-gl';
import Radar from 'radar-sdk-js';
import 'radar-sdk-js/dist/radar.css';
import { onMounted, ref } from 'vue';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import Show from './posts/show.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const Props = defineProps(['weather', 'city', 'markers']);

const mapMouseEv = ref<MapMouseEvent>();

const form = useForm({
    title: '',
    description: '',
    latitude: '',
    longitude: '',
});
const submit = () => {
    form.post(route('marker.store'));
};

Radar.initialize('prj_live_pk_581819a64edfdc6543371d189067bff15b1a6314');
onMounted(() => {
    const map = Radar.ui.map({
        container: 'map', // OR document.getElementById('map')
        style: 'radar-dark-v1',
        center: [22.488819593503443, 58.25398239259826], // NYC
        zoom: 14,
    });
    for (let marker of Props.markers) {
        Radar.ui
            .marker({
                color: '#000257',
                width: 40,
                height: 80,
                popup: {
                    text: marker.name,
                },
            })
            .setLngLat([marker.longitude, marker.latitude])
            .addTo(map);
    }

    map.on('click', (e) => {
        form.latitude = e.lngLat.lat.toString();
        form.longitude = e.lngLat.lng.toString();
        Show.value = true;
    });
});
</script>
<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div
                    class="relative flex aspect-video flex-col items-center justify-center overflow-hidden rounded-xl border border-sidebar-border/70 bg-gray-50 p-4 text-center dark:border-sidebar-border dark:bg-gray-800"
                >
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ city }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Temperature:</strong> {{ weather.main.temp }}&#176;C</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Humidity:</strong> {{ weather.main.humidity }}%</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Clouds:</strong> {{ weather.clouds.all }}%</p>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    {{ mapMouseEv?.lngLat?.lng }}
                    {{ mapMouseEv?.lngLat?.lat }}

                    <form @submit.prevent="submit">
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="mb-2 w-full rounded-md border border-gray-300 p-2 text-black"
                            placeholder="nimi"
                            v-model="form.title"
                        />
                        <input type="submit" value="Salvesta" class="mb-2 w-full cursor-pointer rounded-md bg-blue-500 p-2 text-white" />
                    </form>
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div
                class="relative min-h-[100vh] flex-1 overflow-clip rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min"
            >
                <div id="map" style="width: 100%; height: 100%" />
                
            </div>
        </div>
    </AppLayout>
</template>
