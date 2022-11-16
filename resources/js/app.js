import create from "zustand/vanilla";
import { persist, subscribeWithSelector } from 'zustand/middleware'


const userStore = create(   subscribeWithSelector( persist(
      (set, get) => ({
          user:{id:0, name:'guest', status:'visitor' },
          login:(...args)=>
            fetch('/login',{method:  'POST', 
                            headers: {"X-CSRF-Token": args[1].querySelector('[name="_token"]').value},
                            body:    new FormData(args[1]) })
                  .then(r=>r.json())
                  .then(r=>{
                      if(r.status) 
                        return set({user:r.result});
                      NotifCreate(r.message)
                      }),
          logout:(...args)=>
            fetch('/auth/logout', {method:'GET'}).then(r=>r.json()).then(r=>{
              if(r.status)
                return set({user:r})
            } ),
          setUser:()=>set(s=>({user:{id:8, name:'osman', status:'panel' }})),
          console:(...args)=>{console.log(args); get().login(...args); return false},
          kediFiyatlari:0
      }),
      {
        name: 'userStore', // name of item in the storage (must be unique)
        getStorage: () => sessionStorage, // (optional) by default the 'localStorage' is used
      }
)))

function NotifCreate(msg, timeout=3000){
  let elem = document.createElement('div');
  elem.classList.add('notification')
  elem.innerHTML = msg
  document.querySelector('.notifZone').insertAdjacentElement('beforeend', elem)
  setTimeout(()=>elem.remove(), timeout)
}


 window.userStore = userStore 
 userStore.subscribe(state=>state.user, k=>{ console.log('user state change', k);  document.querySelector('.root').dataset.userstatus=k.Status??'guest'})
