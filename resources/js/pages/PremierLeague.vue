<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

import Pick11 from '@/components/Pick11.vue';
import Leaderboard from '@/components/LeaderBoard.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Premier League',
        href: '/premier-league',
    },
];

type Page = 'pick11' | 'leaderboard';
const currentPage = ref<Page>('pick11');

const switchPage = (page: Page) => {
    currentPage.value = page;
};
</script>

<template>
    <Head title="Premier League" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">

            <!-- Navigation -->
            <div class="mb-4 flex space-x-4">
                <button
                    @click="switchPage('pick11')"
                    :class="currentPage === 'pick11' ? 'font-bold underline' : ''"
                >
                    Start 11
                </button>
                <button
                    @click="switchPage('leaderboard')"
                    :class="currentPage === 'leaderboard' ? 'font-bold underline' : ''"
                >
                    Leaderboard
                </button>
            </div>

            <!-- Page Content -->
            <div class="relative min-h-[80vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border p-4">
                <Pick11 v-if="currentPage === 'pick11'" />
                <Leaderboard v-if="currentPage === 'leaderboard'" />
            </div>

        </div>
    </AppLayout>
</template>
