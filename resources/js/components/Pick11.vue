<script setup lang="ts">
import { ref, onMounted } from 'vue';
import PlayerList from './PlayerList.vue';
import axios from 'axios';

interface Player {
    id: number;
    name: string;
    full_name: string;
    team: string;
    position: string;
    price: number;
    stats?: { points: number }[];
}

const players = ref<Player[]>([]);
const selectedPlayers = ref<number[]>([]);
const captainId = ref<number | null>(null);

const playerName = (id: number) => {
    const p = players.value.find(pl => pl.id === id);
    return p ? p.full_name : '';
};

const saveTeam = async () => {
    if (selectedPlayers.value.length !== 11 || !captainId.value) return;

    await axios.post('/api/teams', {
        players: selectedPlayers.value,
        captain_id: captainId.value
    });
    alert('Team saved!');
};

onMounted(async () => {
    const res = await axios.get(`/api/players`);
    players.value = res.data;
});
</script>

<template>
    <div>
        <h1 class="mb-4">Vælg 11 spillere</h1>
        <PlayerList
            :players="players"
            :selectedPlayers="selectedPlayers"
            @update:selectedPlayers="selectedPlayers = $event"
        />
        <label>
            Captain:
            <select v-model="captainId">
                <option v-for="id in selectedPlayers" :key="id" :value="id">
                {{ playerName(id) }}
                </option>
            </select>
        </label>
        <button @click="saveTeam" :disabled="selectedPlayers.length !== 11 || !captainId">
            Save Team
        </button>
    </div>
</template>
