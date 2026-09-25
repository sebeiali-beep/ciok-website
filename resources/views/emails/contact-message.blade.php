<x-mail::message>
# 📬 Nouveau message de contact

Vous avez reçu un nouveau message depuis le site **CIOK**.

**Nom :** {{ $contact->name }}  
**Email :** {{ $contact->email }}  
**Téléphone :** {{ $contact->phone ?: 'Non renseigné' }}  
**Sujet :** {{ $contact->subject }}

---

**Message :**

{{ $contact->message }}

<x-mail::button :url="'mailto:' . $contact->email">
✉️ Répondre à {{ $contact->name }}
</x-mail::button>

---

<small>Message reçu le {{ $contact->created_at->format('d/m/Y à H:i') }}</small>

Cordialement,  
**Le site CIOK**
</x-mail::message>