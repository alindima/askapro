@extends('templates.master')

@section('title')
	{{ trans('home.title') }} - AskAPro
@stop

@section('content')
    <nav class="home nav">
        <div class="logo">
            <a href="{{ route('home') }}">
                { AskAPro }
            </a>
        </div>
        
        <input type="checkbox" id="menu-toggler" class="menu-toggler-checkbox">
        <label for="menu-toggler" class="menu-toggler">
            <i class="fa fa-bars"></i>
        </label>

        <ul>
            <li>
                <a href="{{ route('questions') }}">Find an answer</a>
            </li>

            <li>
                <a href="{{ route('premium') }}">Premium</a>
            </li>

            <li>
                <a href="{{ route('signup') }}">Sign up</a>
            </li>

            <li>
                <a href="{{ route('login') }}">Log in</a>
            </li>

            <li class="lang-li">
                <a class="normal-link lang-button" href="#" data-toggle="modal" data-target="#languageModal">
                    Lang <i class="fa fa-caret-down"></i>
                </a>
            </li>
        </ul>   
    </nav>
    
    <div class="home main-wrapper">
        <div class="home section1 col-xs-12">    
            <section>
                The ultimate platform for finding answers to all of your programming questions and problems.<br><br>
                Why don't you just <span class="focus">ask a pro</span>?

            </section>   
            
            <div class="more">
                <a href="#more">
                    <i class="fa fa-angle-double-down"></i>
                </a>
            </div>
        </div>
        
        <div class="home col-xs-12 section2">
            <section class="home" id="more">
                <div class="window">
                  <div class="titlebar">
                    <div class="buttons">
                      <div class="close">
                        <a class="closebutton" href="#"><span><strong>x</strong></span></a>
                      </div>
                      <div class="minimize">
                        <a class="minimizebutton" href="#"><span><strong>&ndash;</strong></span></a>
                      </div>
                      <div class="zoom">
                        <a class="zoombutton" href="#"><span><strong>+</strong></span></a>
                      </div>
                    </div>
                    Terminal
                  </div>
                  <div class="content">
                    user@askapro:~$ show message <br><br>
                    <div class="main">
                        {!! trans('home.main_message') !!}
                        <br>    
                        <div class="link">
                            <a href="{{ route('premium') }}">Find out more</a>
                        </div>
                    </div>
                  </div>
                </div>
            </section>
        </div>
    </div>

    <div class="home section-footer">
        <footer class="col-xs-12">
            <div class="col-md-4 footer-part part1">
                <div class="logo">
                    { AskAPro }
                </div>
                <p>We help you fix the bugs that are keeping you from fulfilling your dreams.</p>
            </div>
            <div class="col-md-4 footer-part part2">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, soluta, nulla. Perspiciatis fuga architecto mollitia consectetur quibusdam fugit ullam perferendis ratione ipsam, id consequatur vel nihil sapiente aut incidunt placeat.
            </div>
            <div class="col-md-4 footer-part part3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, soluta, nulla. Perspiciatis fuga architecto mollitia consectetur quibusdam fugit ullam perferendis ratione ipsam, id consequatur vel nihil sapiente aut incidunt placeat.
            </div>
        </footer>
    </div>

    @include('templates.partials.language_modal')
@stop