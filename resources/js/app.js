import create from "zustand/vanilla";
import { persist, subscribeWithSelector } from 'zustand/middleware'


const userStore = create(   subscribeWithSelector( persist(
      (set, get) => ({
          user:{id:0, name:'guest', status:'visitor' },
          login:(args)=>
            fetch('/auth/login',{method:'POST', body:JSON.stringify(args) }).then(r=>r.json()).then(r=>set({user:r})),
          logout:(args)=>
            fetch('/auth/logout', {method:'GET'                           }).then(r=>r.json()).then(r=>set({user:r})),
          setUser:()=>set(s=>({user:{id:8, name:'osman', status:'panel' }})),
          kediFiyatlari:0
      }),
      {
        name: 'userStore', // name of item in the storage (must be unique)
        getStorage: () => sessionStorage, // (optional) by default the 'localStorage' is used
      }
)))

 window.userStore = userStore
 userStore.subscribe(state=>state.user, k=>document.querySelector('.root').dataset.userStatus=k.user.status)
