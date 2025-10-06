<script setup lang="ts">
import PlayerCard from './PlayerCard.vue';

interface Player {
    id: number;
    name: string;
    full_name: string;
    team: string;
    position: string;
    price: number;
    stats?: { points: number }[];
}

const props = defineProps<{
    players: Player[];
    selectedPlayers: number[];
}>();

const emit = defineEmits<{
    (e: 'update:selectedPlayers', players: number[]): void;
}>();

const togglePlayer = (player: Player) => {
    let arr = [...props.selectedPlayers];
    if (arr.includes(player.id)) {
        arr = arr.filter(id => id !== player.id);
    } else if (arr.length < 11) {
        arr.push(player.id);
    }
    emit('update:selectedPlayers', arr);
};
</script>

<template>
    <div class="grid grid-cols-3 gap-2">
        <PlayerCard
            v-for="player in players"
            :key="player.id"
            :player="player"
            :selected="selectedPlayers.includes(player.id)"
            @select="togglePlayer"
        />
    </div>
</template>
