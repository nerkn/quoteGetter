
    function fetchX(url, data, fthen){
      fetch(url, {method:'Post', body:JSON.stringify(data)}).then((r)=>r.json()).then((r)=>fthen(r))
    }
    function formSubmit(e, fthen, url='?'){ // onsubmit='return generiSubmit(this)'
      fetch(url, {method:'POST', body: new URLSearchParams(new FormData(e)), headers: {'Content-Type': 'application/x-www-form-urlencoded'}
         }).then((r)=>r.json()).then((r)=>{fthen?fthen(r):Notification(r.message);})
      return false
    }
