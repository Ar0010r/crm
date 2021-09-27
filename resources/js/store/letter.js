import {container} from '../services/index'
import {emitter} from '../app';

export default {
    namespaced: true,
    state: {
        letters: {},
        emptyLetter: {
            hr_id: null,
            hr: {login: null},
            google: null,
            yahoo: null,
            outlook: null,
            other: null,
            received_at: null
        }
    },
    mutations: {
        async setLetters(state, letters) {
            state.letters = letters;
        },
        setLetterById(state, letter) {
            let key = letter.id;
            if (state.letters[key]) {
                state.letters[key] = {...state.letters[key], ...letter};

            } else {
                let newLetterObj = {};
                newLetterObj[key] = letter;
                state.letters = {...newLetterObj, ...state.letters};
            }
        },
        deleteLetterById(state, id) {
            delete state.letters[id];
        }
    },
    actions: {
        async setLettersToStore({commit, dispatch}) {
            try {
                let lettersList = await container.LetterService.get();
                lettersList = lettersList.data.list;

                let letters = {};
                Object.keys(lettersList).map(function (key) {
                    let index = lettersList[key].id;
                    letters[index] = lettersList[key];
                });

                commit('setLetters', letters);
            } catch (e) {
                console.log('error', e)
                emitter.emit('notification-error', e.response.data)
                if (e.response.status === 401) container.AuthService.logout()
            }
        },

        deleteLetter({commit, dispatch, state}, letter) {
            let key = letter.id;
            if (state.letters[key]) {
                commit('deleteLetterById', key);
            } else {
                emitter.emit('notification-error', e.response.data)
            }
        }
    },
}
