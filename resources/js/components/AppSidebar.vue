<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, ChartColumnBig, History, Heart, Gamepad2 } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Leaderboard',
        href: '/leaderboard',
        icon: ChartColumnBig,
    },
    {
        title: 'Spilhistorik',
        href: '/spilhistorik',
        icon: History,
    },
];

const shortcutNavItems: NavItem[] = [
    {
        title: 'Premier League',
        href: '/premier-league',
        icon: Gamepad2,
    }
]

const footerNavItems: NavItem[] = [
    {
        title: 'Regler og Info',
        href: '/regler-og-info',
        icon: BookOpen,
    },
    {
        title: 'Om Start 11',
        href: '/om-start-11',
        icon: Heart,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <div class="flex flex-col gap-6">
            <SidebarContent>
                <NavMain :items="mainNavItems" :label="'Platform'" />
            </SidebarContent>
            <SidebarContent>
                <NavMain :items="shortcutNavItems" :label="'Genvej til dit yndlings spil'" />
            </SidebarContent>
        </div>

        <SidebarFooter class="mt-auto">
            <NavMain :items="footerNavItems" :label="'Information'" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
