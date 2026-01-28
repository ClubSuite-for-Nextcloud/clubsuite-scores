<template>
  <div id="content" class="app-content">
    <div class="app-navigation">
        <ul class="with-icon">
            <li :class="{ active: view === 'scores' }">
                <a href="#" @click.prevent="view = 'scores'">
                    <span class="icon-params"><MusicNoteIcon :size="20" /></span>
                    Notenarchiv
                </a>
            </li>
            <li :class="{ active: view === 'assignments' }">
                <a href="#" @click.prevent="view = 'assignments'">
                    <span class="icon-params"><AccountMusicIcon :size="20" /></span>
                    Ausgabe
                </a>
            </li>
        </ul>
    </div>

    <div id="app-content">
        <!-- SCORES VIEW -->
        <div v-if="view === 'scores'" class="view-container">
            <div class="header">
                <h2>Notenarchiv</h2>
                <div class="actions">
                    <button class="primary" @click="showCreate = true">Hinzufügen</button>
                    <button @click="loadScores"><RefreshIcon :size="20"/></button>
                </div>
            </div>

            <div v-if="showCreate" class="create-form">
                <h3>Neues Stück</h3>
                <form @submit.prevent="createScore">
                    <div class="form-group">
                        <label>Titel</label>
                        <input type="text" v-model="newScore.title" required class="form-control" placeholder="Titel des Musikstücks">
                    </div>
                    <div class="form-group">
                        <label>Komponist</label>
                        <input type="text" v-model="newScore.composer" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Genre</label>
                        <input type="text" v-model="newScore.genre" class="form-control">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="primary">Speichern</button>
                        <button type="button" @click="showCreate = false">Abbrechen</button>
                    </div>
                </form>
            </div>

            <table class="grid-table">
                <thead><tr><th>Titel</th><th>Komponist</th><th>Genre</th><th>Aktionen</th></tr></thead>
                <tbody>
                    <tr v-for="s in scores" :key="s.id">
                        <td>{{ s.title }}</td>
                        <td>{{ s.composer || '-' }}</td>
                        <td>{{ s.genre || '-' }}</td>
                        <td>
                             <button @click="deleteScore(s.id)" class="icon-button"><DeleteIcon :size="16"/></button>
                        </td>
                    </tr>
                    <tr v-if="scores.length === 0"><td colspan="4">Keine Noten gefunden</td></tr>
                </tbody>
            </table>
        </div>

        <div v-if="view === 'assignments'">
            <h2>Ausgabe & Verteilung</h2>
            <p>Hier wird dokumentiert, wer welche Noten hat.</p>
        </div>
    </div>
  </div>
</template>

<script>
// Standard Vue 2
import MusicNoteIcon from 'vue-material-design-icons/MusicNote.vue'
import AccountMusicIcon from 'vue-material-design-icons/AccountMusic.vue'
import RefreshIcon from 'vue-material-design-icons/Refresh.vue'
import DeleteIcon from 'vue-material-design-icons/Delete.vue'

export default {
  name: 'ScoresApp',
  components: {
    MusicNoteIcon, AccountMusicIcon, RefreshIcon, DeleteIcon
  },
  data() {
    return {
      view: 'scores',
      scores: [],
      showCreate: false,
      newScore: { title: '', composer: '', genre: '' }
    }
  },
  mounted() {
      this.loadScores()
  },
  methods: {
      async loadScores() {
          try {
              const res = await fetch(OC.generateUrl('/apps/clubsuite-scores/api/scores'))
              if(res.ok) {
                  const data = await res.json()
                  this.scores = Array.isArray(data) ? data : (data.rows || [])
              }
          } catch(e) { console.error(e) }
      },
      async createScore() {
          try {
              const res = await fetch(OC.generateUrl('/apps/clubsuite-scores/api/scores'), {
                  method: 'POST',
                  headers: {'Content-Type': 'application/json', 'requesttoken': OC.requestToken},
                  body: JSON.stringify(this.newScore)
              })
              if(res.ok) {
                  this.showCreate = false
                  this.newScore = { title: '', composer: '', genre: '' }
                  this.loadScores()
              }
          } catch(e) { console.error(e) }
      },
      async deleteScore(id) {
          if(!confirm('Endgültig löschen?')) return;
          try {
              await fetch(OC.generateUrl('/apps/clubsuite-scores/api/scores/' + id), {
                   method: 'DELETE',
                   headers: {'requesttoken': OC.requestToken}
              })
              this.loadScores()
          } catch(e) { console.error(e) }
      }
  }
}
</script>

<style scoped>
.app-content { display: flex; height: 100vh; overflow: hidden; }
.app-navigation { width: 300px; border-right: 1px solid var(--color-border); padding-top: 10px; background: var(--color-main-background); }
#app-content { flex-grow: 1; padding: 20px; overflow-y: auto; }
.with-icon { list-style: none; padding: 0; margin: 0; }
.with-icon a { display: flex; align-items: center; padding: 10px 15px; text-decoration: none; color: var(--color-main-text); opacity: 0.7; }
.with-icon li.active a { opacity: 1; font-weight: bold; background: var(--color-background-hover); }
.icon-params { margin-right: 10px; display: flex; }

.header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid var(--color-border); padding-bottom: 10px; }
.grid-table { width: 100%; border-collapse: collapse; }
.grid-table th, .grid-table td { padding: 10px; border-bottom: 1px solid var(--color-border); text-align: left; }
.icon-button { background: none; border: none; cursor: pointer; opacity: 0.6; }
.icon-button:hover { opacity: 1; }

.create-form { background: var(--color-background-hover); padding: 15px; border-radius: 5px; margin-bottom: 20px; }
.form-group { margin-bottom: 10px; }
.form-group label { display: block; font-weight: bold; }
.form-control { width: 100%; padding: 5px; border: 1px solid var(--color-border); }
button.primary { background-color: var(--color-primary); color: var(--color-primary-text); border: none; padding: 8px 12px; border-radius: 3px; cursor: pointer; margin-right: 5px; }
button { cursor: pointer; }
</style>
