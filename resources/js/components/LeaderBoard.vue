<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';

interface LeaderboardUser {
    id: number;
    name: string;
    total_score: number;
}

const leaderboard = ref<LeaderboardUser[]>([]);

onMounted(async () => {
    const res = await axios.get('/api/leaderboard');
    leaderboard.value = res.data;
});
</script>

<template>
    <div>
        <h1>Leaderboard</h1>
        <table class="table-auto border">
            <thead>
                <tr>
                <th>Rank</th>
                <th>User</th>
                <th>Total Points</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in leaderboard" :key="user.id">
                <td>{{ index + 1 }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.total_score }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
