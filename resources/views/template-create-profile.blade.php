{{--
  Template Name: Create Profile
--}}

@extends('layouts.app-clean')

@section('content_step_1')

    @debug('hierarchy')

    <div class="hero-sm  mt-20 mb-0">
        <div class="hero-sm__top">
            <svg class="hero-sm__logo">
                <use xlink:href="#wype"></use>
            </svg>
        </div>

        <div class="hero-sm__content">
            <h1 class="hero-sm__h1">Opdatér dine oplysninger til din Wype-bruger</h1>
            <p class="hero-sm__p">Som Wype-abonnenet har du nu mulighed for at logge ind med din e-mail og din adgangskode.</p>
            <form method="post" action="" class="form" >
                <input type="hidden" name="csrf" value="{{ $csrf_token }}" />
                <input type="hidden" name="validateSubscriptionNumber" value="1" />
                <input type="hidden" name="step" value="2">

                <div class="form__row ">
                    <label for="input-subscriber" class="form__label">Abonnementsnummer</label>
                    <div class="form__wrapper">
                        <input type="number" class="form__control " name="subscriptionNumber" id="input-subscriber" placeholder="Indtast 10 cifre" />
                    </div>

                    <div class="form__error-message">
                        Abonnementsnummeret er ugyldigt
                    </div>

                    <div class="form__help">
                        <a href="#" class="js-toggle-help">Glemt abonnementsnummer?</a>
                        <div class="form__helpwrapper" id="form-help">
                            <div class="form__helpcontent" >
                                <a href="#" class="form__helpclose js-toggle-help"></a>
                                <h2>Hvor finder jeg mit abonnementsnummer?</h2>

                                <p>Du kan finde dit abonnementsnummer et af følgende steder:</p>
                                <ul>
                                    <li>Dit seneste girokort</li>
                                    <li>På A4-papiret der var vedlagt dit seneste magasin</li>
                                    <li>Din bekræftelses e-mail ved oprettelsen</li>
                                </ul>
                                <p><a href="https://bonnierpublications.com/kontakt/" target="_blank">Kontakt kundeservice</a></p>
                            </div>
                        </div>
                    </div>



                </div>

                <div class="form__row ">
                    <label for="input-subscriber" class="form__label">Postnummer.:</label>
                    <div class="form__wrapper">
                        <input type="number" class="form__control " name="zip" id="input-zip" placeholder="Fx. 2100" />
                    </div>

                    <div class="form__error-message">
                        Postnummeret er ugyldigt
                    </div>

                </div>

                <div class="form__row">
                    <button class="btn btn--primary btn--block " id="submit" >
                        Kom i gang <svg class="btn--primary__icon ml-10">
                            <use xlink:href="#icon-next"></use>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <footer class="hero-sm__footer">
            Bonnier kundeservice +45 39 10 30 00
        </footer>
    </div>
@endsection

@section('content_step_2')
    <div class="hero-sm   mt-20 mb-0">
        <div class="hero-sm__top">
            <svg class="hero-sm__logo">
                <use xlink:href="#wype"></use>
            </svg>
        </div>

        <div class="hero-sm__content">
            <h1 class="hero-sm__h1">Tjek dine oplysninger</h1>
            <p class="hero-sm__p">Dit abonnementsnummer er tilknyttet nedenstående oplysninger</p>
            <form method="post" action="" class="form">
                <input type="hidden" name="csrf" value="{{ $csrf_token }}" />
                <input type="hidden" name="submitUserInfo" value="1" />
                <input type="hidden" name="step" value="3">
                <input type="hidden" name="subscriptionNumber" value="{{ $subscription_number }}">

                <div class="form__row ">
                    <label for="input-firstname" class="form__label">Fornavn</label>
                    <div class="form__wrapper">
                        <input type="text" class="form__control" value="{{ $first_name }}" id="input-firstname" placeholder="Fornavn" disabled>
                    </div>

                    <div class="form__error-message">
                        Du skal indtaste dit fornavn
                    </div>
                </div>

                <div class="form__row ">
                    <label for="input-lastname" class="form__label">Efternavn</label>
                    <div class="form__wrapper">
                        <input type="text" class="form__control" value="{{ $last_name }}" id="input-lastname" placeholder="Efternavn" readonly>
                    </div>

                    <div class="form__error-message">
                        Du skal indtastet dit efternavn
                    </div>
                </div>

                <div class="form__row ">
                    <label for="input-email" class="form__label">E-mail</label>
                    <div class="form__wrapper">
                        <input type="email" class="form__control" name="email" id="input-email" placeholder="E-mail" value="{{ $email }}" required>
                    </div>

                    <div class="form__error-message">
                        E-mailadressen er ugyldig
                    </div>
                </div>

                <div class="form__row form__row--password hide-password ">
                    <label for="input-password" class="form__label">Adgangskode</label>
                    <div class="form__wrapper ">
                        <svg class="form__row--icon">
                            <use xlink:href="#icon-password"></use>
                        </svg>

                        <input name="password" class="form__control form__control--password form__control--has-icon" tabindex="0" type="password" autocomplete="" value="" id="input-password" maxlength="32" placeholder="Vælg ny adgangskode" required>

                        <a href="#" class="btn--toggle-password js-toggle-password" role="button">
						<span class="field--password--show">
							<svg class="password-icon">
								<use xlink:href="#password-hidden"></use>
							</svg>
							</span>
                            <span class="field--password--hide">
								<svg class="password-icon">
									<use xlink:href="#password-visible"></use>
								</svg>
							</span>
                        </a>
                    </div>

                    <div class="form__help">
                        <a href="#">Din adgangskode skal bestå af mindst 6 karakterer</a>
                    </div>
                </div>

                <div class="form__row">
                    <button class="btn btn--primary btn--block " id="submit">
                        Opdater din profil <svg class="btn--primary__icon ml-10">
                            <use xlink:href="#icon-next"></use>
                        </svg>
                    </button>
                </div>

                <footer class="hero-sm__footer">
                    Bonnier kundeservice +45 39 10 30 00
                </footer>

                <use xlink:href="#icon-arrow"></use>

            </form>
        </div>
    </div>
@endsection

@section('content_success')
    <div class="hero-sm mt-20 mb-0">
        <div class="hero-sm__top">
            <svg class="hero-sm__logo">
                <use xlink:href="#wype"></use>
            </svg>
        </div>
        <div class="hero-sm__content">
            <svg class="hero-sm__icon">
                <use xlink:href="#check"></use>
            </svg>

            <h1 class="hero-sm__h1 text-center">Du klarede den!</h1>
            <p class="hero-sm__p text-center">Din profil er nu opdateret.</p>
        </div>
    </div>
@endsection
