import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

export const vuetify = createVuetify({
  icons: {
    iconfont: 'mdi'
  },
  directives,
  components,
  defaults: {
    VTextField: {
      variant: 'outlined',
      bgColor: 'white',
      density: 'compact'
    },
    VSelect: {
      variant: 'outlined',
      bgColor: 'white',
      density: 'compact'
    },
    VTextarea: {
      variant: 'outlined',
      bgColor: 'white',
      density: 'compact'
    }
  }
})
