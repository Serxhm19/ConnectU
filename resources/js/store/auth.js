import axios from 'axios';

export default {
    namespaced: true,
    state: {
        authenticated: false,
        user: {}
    },
    getters: {
        authenticated(state) {
            return state.authenticated
        },
        user(state) {
            return state.user
        }
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value
        },
        SET_USER(state, value) {
            state.user = value
        }
    },
    actions: {
        async login({ commit }) {
            try {
                const userResponse = await axios.get('/api/user');
                commit('SET_USER', userResponse.data);
                commit('SET_AUTHENTICATED', true);
            } catch (error) {
                try {
                    const promoterResponse = await axios.get('/api/promoter');
                    commit('SET_USER', promoterResponse.data);
                    commit('SET_AUTHENTICATED', true);
                } catch (error) {
                    commit('SET_USER', {});
                    commit('SET_AUTHENTICATED', false);
                }
            }
        },
        getUser({ commit }) {
            return axios.get('/api/user').then(({ data }) => {
                if (data.success) {
                    commit('SET_USER', data.data)
                    commit('SET_AUTHENTICATED', true)
                }
            }).catch(error => {
                commit('SET_USER', {})
                commit('SET_AUTHENTICATED', false)
            })
        },
        getPromoter({ commit }) {
            return axios.get('/api/promoter').then(({ data }) => {
                if (data.success) {
                    commit('SET_USER', data.data)
                    commit('SET_AUTHENTICATED', true)
                }
            }).catch(error => {
                commit('SET_USER', {})
                commit('SET_AUTHENTICATED', false)
            })
        },
        logout({ commit }) {
            commit('SET_USER', {})
            commit('SET_AUTHENTICATED', false)
        }
    }
}
