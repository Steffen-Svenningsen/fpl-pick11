<script setup lang="ts">
import TeamLabel from './TeamLabel.vue';

interface PlayerStat {
    points: number;
}

interface Player {
    id: number;
    name: string;
    full_name: string;
    team: string;
    position: string;
    price: number;
    stats?: PlayerStat[];
}

const props = defineProps<{
    player: Player;
    selected: boolean;
}>();

const emit = defineEmits<{
    (e: 'select', player: Player): void;
}>();
</script>

<template>
    <button
        class="border p-2 rounded shadow relative text-left cursor-pointer overflow-hidden"
        :class="selected ? 'border-green-500' : 'border'"
        @click="$emit('select', player)"
    >
        <h3>{{ player.full_name }}</h3>
        <p>Team: {{ player.team }}</p>
        <p>Position: {{ player.position }}</p>
        <p>Price: £{{ player.price }}</p>
        <p v-if="player.stats?.length">Last GW Points: {{ player.stats[0].points }}</p>
        <TeamLabel />
    </button>
</template>
