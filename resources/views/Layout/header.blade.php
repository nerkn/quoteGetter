<div class='header flex max-w-7xl '>
  <div><a href='/'>Orderer</a></div>
  <div>Welcome  </div>
  <div class='text-right'>
    <div class="relative  showChildWhenOver  inline ">
          <a href='/profile'>Profile</a>
          <div class="hidden">
          <form class='userStatus logout loginForm flexColumn bg-white rounded-lg border border-gray-100 shadow-md text-left top-4'
                onsubmit="userStore.getState().login(event,this);return false;"
                action='/login' >
                @csrf
            <label><span>Username : </span>              <input name='email'    type='email' /> </label>
            <label><span>Password : </span>              <input name='password' type='password' /> </label>
            <div> <input type='submit' name='Login' value='Register' />
                  <input type='submit' name='Login' value="Login"    /></div>
          </form>
          </div>
          <div class="hidden">
            <div class="userStatus login flexColumn bg-white rounded-lg border border-gray-100 shadow-md text-left top-4">
                  <a href="/logout" onclick="userStore.getState().logout();event.preventDefault();">Logout</a>
            </div>
          </div>
    </div>  
    <a href='/profile/preferences'>Preferences</a>    
  </div>
</div>

