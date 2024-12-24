<?php
return [
    'login' => [
        'email' => [
            'required' => 'L\'email est requis.',
            'email' => 'Format d\'email invalide.',
        ],
        'password' => [
            'required' => 'Le mot de passe est requis.',
            'string' => 'Le mot de passe doit être une chaîne de caractères.',
            'min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        ],
        'check' => 'L\'email ou le mot de passe est incorrect ou n\'existe pas.',
        'login_required' => 'Vous devez vous connecter pour accéder à cette page.',
    ],
    'register' => [
        'email' => [
            'required' => 'L\'email est requis.',
            'email' => 'Format d\'email invalide.',
            'unique' => 'Cette adresse email est déjà enregistrée.',
        ],
        'password' => [
            'required' => 'Le mot de passe est requis.',
            'string' => 'Le mot de passe doit être une chaîne de caractères.',
            'min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ],
        'check' => 'L\'email ou le mot de passe est incorrect ou n\'existe pas.',
        'login_required' => 'Vous devez vous connecter pour accéder à cette page.',
    ],
    'validation' => [
        'name' => [
            'required' => 'Le nom de la variante est obligatoire.',
            'string' => 'Le nom de la variante doit être une chaîne de caractères.',
            'max' => 'Le nom de la variante ne doit pas dépasser 255 caractères.',
        ],
        'description' => [
            'string' => 'La description doit être une chaîne de caractères.',
        ],
        'variant_images' => [
            'array' => 'Les images doivent être fournies sous forme de tableau.',
            'image' => 'Chaque fichier téléchargé doit être une image.',
            'mimes' => 'Chaque image doit être au format suivant : jpeg, png, jpg, gif.',
            'max' => 'Chaque image ne doit pas dépasser 2 Mo.',
        ],
        'reason' => [
            'required' => 'Vous devez fournir une raison pour supprimer la variante.',
        ]
    ],
    'room_validation' => [
        'name' => [
            'required' => 'Le nom de la chambre est obligatoire.',
            'string' => 'Le nom de la chambre doit être une chaîne de caractères.',
            'max' => 'Le nom de la chambre ne doit pas dépasser 255 caractères.',
        ],
        'description' => [
            'string' => 'La description doit être une chaîne de caractères.',
        ],
        'room_images' => [
            'array' => 'Les images doivent être fournies sous forme de tableau.',
            'image' => 'Chaque fichier téléchargé doit être une image.',
            'mimes' => 'Chaque image doit être au format suivant : jpeg, png, jpg, gif.',
            'max' => 'Chaque image ne doit pas dépasser 2 Mo.',
        ],
        'reason' => [
            'required' => 'Vous devez fournir une raison pour supprimer la chambre.',
        ],
        'destination_id' => [
            'required' => 'Vous devez sélectionner une destination.',
            'integer' => 'La destination doit être un entier valide.',
            'exists' => 'La destination sélectionnée est invalide.',
        ],
        'price' => [
            'required' => 'Le prix de la chambre est obligatoire.',
            'numeric' => 'Le prix de la chambre doit être un nombre.',
            'min' => 'Le prix de la chambre doit être supérieur ou égal à 0.',
        ],
        'variant_id' => [
            'required' => 'Vous devez sélectionner au moins une variante.',
            'array' => 'Les données de la variante doivent être sous forme de tableau.',
            'min' => 'Vous devez sélectionner au moins une variante.',
            'integer' => 'L\'ID de la variante doit être un entier.',
            'exists' => 'La variante sélectionnée n\'existe pas.',
        ],
        'quantity' => [
            'required' => 'La quantité de chambres est obligatoire.',
            'integer' => 'La quantité de chambres doit être un entier.',
            'min' => 'La quantité de chambres doit être supérieure ou égale à 1.',
            'max' => 'La quantité de chambres doit être inférieure ou égale à 25.',
        ],
        'guest_quantity' => [
            'required' => 'Le nombre de clients est obligatoire.',
            'integer' => 'Le nombre de clients doit être un entier.',
            'min' => 'Le nombre de clients doit être supérieur ou égal à 1.',
            'max' => 'Le nombre de clients doit être inférieur ou égal à 4.',
        ],

    ],
    'category_validation' => [
        'name' => [
            'required' => 'Le nom de la catégorie est requis.',
            'string' => 'Le nom de la catégorie doit être une chaîne de caractères.',
            'max' => 'Le nom de la catégorie ne doit pas dépasser la longueur maximale.',
            'unique' => 'Ce nom de catégorie a déjà été créé.',
        ],
        'description' => [
            'string' => 'La description doit être une chaîne de caractères.',
        ],
        'images' => [
            'array' => 'Les images doivent être fournies sous forme de tableau.',
            'image' => 'Chaque fichier doit être une image.',
            'mimes' => 'Chaque image doit être de type : jpeg, png, jpg, gif.',
            'max' => 'Chaque image ne doit pas dépasser la taille maximale.',
        ],
        'deleted_reason' => [
            'required' => 'La raison de la suppression est requise.',
            'string' => 'La raison de la suppression doit être une chaîne de caractères.',
            'max' => 'La raison de la suppression ne doit pas dépasser la longueur maximale.',
        ],
    ],
    'banner_validation' => [
        'img_banner' => [
            'image' => 'L\'image doit être une image.',
            'mimes' => 'L\'image doit être de type : jpeg, png, jpg, gif.',
            'max' => 'L\'image ne doit pas dépasser la taille maximale.',
            'required' => 'L\'image est requise.',
        ],
        'reason' => [
            'required' => 'La raison de la suppression est requise.',
            'string' => 'La raison de la suppression doit être une chaîne de caractères.',
            'max' => 'La raison de la suppression ne doit pas dépasser la longueur maximale.',
        ],
    ],
    'forgot_password' => [
        'email' => [
            'required' => 'L\'email est requis.',
            'email' => 'Email invalide.',
            'exists' => 'L\'email n\'existe pas dans le système.',
        ],
        'new_password' => [
            'required' => 'Le mot de passe est requis.',
            'string' => 'Le mot de passe doit être une chaîne de caractères.',
            'min' => 'Le mot de passe doit comporter au moins 8 caractères.',
            'confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ],
        'otp_code' => [
            'required' => 'Le code OTP est requis.',
            'string' => 'Le code OTP doit être une chaîne de caractères.',
        ],
        'check' => 'L\'email est incorrect ou n\'existe pas',
    ],
    'changepassword' => [
        'current_password' => [
            'required' => 'Le mot de passe actuel est requis.',
            'min' => 'Le mot de passe actuel doit contenir au moins 8 caractères.',
        ],
        'new_password' => [
            'required' => 'Le mot de passe est requis.',
            'min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'confirmed' => 'La confirmation du mot de passe ne correspond pas au nouveau mot de passe.',
        ],
        'new_password_confirmation' => [
            'required' => 'Veuillez confirmer le nouveau mot de passe.',
            'min' => 'La confirmation du mot de passe doit contenir au moins 8 caractères.',
        ],
    ],
    'validation_edit_profile' => [
        'name' => [
            'first_name_required' => 'Le prénom est requis.',
            'first_name_string' => 'Le prénom doit être une chaîne de caractères.',
            'first_name_max' => 'Le prénom ne peut pas dépasser 255 caractères.',
            
            'last_name_required' => 'Le nom de famille est requis.',
            'last_name_string' => 'Le nom de famille doit être une chaîne de caractères.',
            'last_name_max' => 'Le nom de famille ne peut pas dépasser 255 caractères.',
        ],
        'displayName' => [
            'display_name_required' => 'Le nom d\'affichage est requis.',
            'display_name_string' => 'Le nom d\'affichage doit être une chaîne de caractères.',
            'display_name_max' => 'Le nom d\'affichage ne peut pas dépasser 255 caractères.',
        ],
        'email' => [
            'email_required' => 'L\'adresse e-mail est requise.',
            'email' => 'L\'adresse e-mail n\'est pas valide.',
            'email_unique' => 'Cette adresse e-mail est déjà utilisée.',
        ],
        'phone' => [
            'phone_number_required' => 'Le numéro de téléphone est requis.',
            'phone_number_regex' => 'Le numéro de téléphone ne peut contenir que des chiffres.',
            'phone_number_max' => 'Le numéro de téléphone ne peut pas dépasser 15 caractères.',
            'phone_number_min' => 'Le numéro de téléphone doit comporter au moins 4 caractères.',
        ],
        'birthday' => [
            'day_required' => 'Le jour est requis.',
            'day_numeric' => 'Le jour doit être un entier.',
            'day_between' => 'Le jour doit être compris entre 1 et 31.',
            'month_required' => 'Le mois est requis.',
            'year_required' => 'L\'année est requise.',
            'year_integer' => 'L\'année doit être un entier.',
            'year_digits' => 'L\'année doit comporter 4 chiffres.',
            'year_min' => 'L\'année n\'est pas valide.',
            'year_max' => 'L\'année ne peut pas dépasser l\'année actuelle.',
        ],
        'address' => [
            'country_required' => 'Le pays est requis.',
            'country_string' => 'Le pays doit être une chaîne de caractères.',
            'country_max' => 'Le pays ne peut pas dépasser 100 caractères.',
            
            'street_required' => 'La rue est requise.',
            'street_string' => 'La rue doit être une chaîne de caractères.',
            'street_max' => 'La rue ne peut pas dépasser 255 caractères.',
            
            'city_required' => 'La ville est requise.',
            'city_string' => 'La ville doit être une chaîne de caractères.',
            'city_max' => 'La ville ne peut pas dépasser 100 caractères.',
            
            'zip_required' => 'Le code postal est requis.',
            'zip_regex' => 'Le code postal doit être numérique.',
            'zip_max' => 'Le code postal ne peut pas dépasser 20 caractères.',
        ],
        'nationality' => [
            'nationality_required' => 'La nationalité est requise.',
        ],
        'gender' => [
            'gender_required' => 'Le genre est requis.',
            'gender_in' => 'Le genre est invalide. Veuillez choisir Homme, Femme ou Autre.',
        ],
        'passport' => [
            'passport_first_name_required' => 'Le prénom du passeport est requis.',
            'passport_first_name_string' => 'Le prénom du passeport doit être une chaîne de caractères.',
            'passport_first_name_max' => 'Le prénom du passeport ne peut pas dépasser 255 caractères.',
            
            'passport_last_name_required' => 'Le nom de famille du passeport est requis.',
            'passport_last_name_string' => 'Le nom de famille du passeport doit être une chaîne de caractères.',
            'passport_last_name_max' => 'Le nom de famille du passeport ne peut pas dépasser 255 caractères.',
            
            'passport_country_required' => 'Le pays du passeport est requis.',
            'passport_country_string' => 'Le pays du passeport doit être une chaîne de caractères.',
            'passport_country_max' => 'Le pays du passeport ne peut pas dépasser 100 caractères.',
            
            'passport_number_required' => 'Le numéro de passeport est requis.',
            'passport_number_regex' => 'Le numéro de passeport doit comporter entre 6 et 9 caractères alphanumériques.',
            'passport_number_max' => 'Le numéro de passeport ne peut pas dépasser 20 caractères.',
            
            'expiry_day_required' => 'Le jour d\'expiration du passeport est requis.',
            'expiry_day_integer' => 'Le jour d\'expiration du passeport doit être un entier.',
            'expiry_day_between' => 'Le jour d\'expiration du passeport doit être compris entre 1 et 31.',
            
            'expiry_month_required' => 'Le mois d\'expiration du passeport est requis.',
            'expiry_month_integer' => 'Le mois d\'expiration du passeport doit être un entier.',
            'expiry_month_between' => 'Le mois d\'expiration du passeport doit être compris entre 1 et 12.',
            
            'expiry_year_required' => 'L\'année d\'expiration du passeport est requise.',
            'expiry_year_min' => 'L\'année d\'expiration du passeport n\'est pas valide.',
            'expiry_year_max' => 'L\'année d\'expiration du passeport ne peut pas dépasser 10 ans à compter de l\'année actuelle.',
        ],
        'success_delete' => 'Supprimé avec succès.',
        'success' => 'Mis à jour avec succès.',
        'success_email' => 'Un e-mail de confirmation a été envoyé. Veuillez vérifier votre boîte de réception.',
    ],
    'history' => [
        'error_day' => 'Vous ne pouvez annuler une réservation que 2 jours à l\'avance.',
    ],


];
