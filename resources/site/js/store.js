import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);
const store = new Vuex.Store(
    {
        state: {
            bg:{},
            loading:true,
        },
        getters:{
            bg(state){
                return ;
            },
        },
        mutations:{
            LOADING(state, onoff){
                state.loading = onoff;
            },
            
        },
        actions:{
        
        },
        modules:{
        
        }
    });
export default store
