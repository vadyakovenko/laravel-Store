@extends('store.layouts.app')

@section('content')
    <section class="bg0 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
                @if(session('success'))
                    <div class="alert alert-success text-center">
                            {{session('success')}}
                    </div> 
                @endif
                @if(session('error'))
                    <div class="alert alert-danger text-center">
                            {{session('error')}}
                    </div> 
                @endif
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md center">

                    <form method="POST" action="{{route('login')}}" >
                        @csrf
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							ВХОД
						</h4>

                        <div class="bor8 m-b-20 how-pos4-parent {{!$errors->has('email') ? :'error'}}">
                            @if($errors->has('email'))
                                <span class="error-message">{{$errors->first('email')}}</span>
                            @endif
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" value="{{old('email')}}" placeholder="Email">
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent {{!$errors->has('password') ? :'error'}}">
                            @if($errors->has('password'))
                                <span class="error-message">{{$errors->first('password')}}</span>
                            @endif
                            <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="password" placeholder="Password">
                            <img class="how-pos4 pointer-none" src="images/icons/icon-password.png" alt="ICON">
                        </div>

                        <label class="remember">Remember me
                            <input name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                        
						<button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Submit
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>	
@endsection
