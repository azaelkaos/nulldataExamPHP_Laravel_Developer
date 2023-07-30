<script setup>
import { ref } from 'vue'
import { useDisplay } from 'vuetify'
const { mobile } = useDisplay()

const drawer = ref(null)
const items = [
  { title: 'Empleados', icon: 'mdi-account-multiple', routeName: 'employees' },
]
</script>

<template>
  <v-navigation-drawer
    ref="drawer"
    dark
    class="nav-drawer bg-deep-purple-darken-4"
    theme="dark"
    permanent
    clipped
    touchless
    :width="200"
    expand-on-hover
    :rail="mobile"
  >
    <v-list color="transparent">
      <v-list-item
        v-for="item in items"
        :key="item.routeName"
        :prepend-icon="item.icon"
        :class="{
          'bg-deep-purple-darken-3 opacity-0_9': $route.name === item.routeName
        }"
        :title="item.title"
        @click="$router.push({ name: item.routeName })"
      />
    </v-list>
    <template #append> </template>
  </v-navigation-drawer>
  <v-main>
    <v-container fluid>
      <v-row>
        <router-view #="{ Component }">
          <transition name="route">
            <v-col cols="12">
              <component :is="Component" />
            </v-col>
          </transition>
        </router-view>
      </v-row>
    </v-container>
  </v-main>
</template>

<style lang="scss" scoped>
.route-enter-from {
  opacity: 0;
  transform: translateX(100px);
}

.route-enter-active {
  transition: all 0.3s ease-out;
}

.route-leave-to {
  opacity: 0;
  transform: translateX(-100px);
}
.route-leave-active {
  transition: all 0.3s ease-in;
}
</style>
