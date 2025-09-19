<?php

namespace App\Livewire;

use Livewire\Component;

class NationalityAndStateInputFields extends Component
{
    public $nationalities;
    public $nationality;
    public $states;
    public $state;

    protected $rules = [
        'nationality' => 'string',
        'state' => 'string',
    ];

    public function mount()
    {
        // Static list of countries - more reliable than depending on external package
        $this->nationalities = collect([
            'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Argentina', 
            'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Bahrain', 'Bangladesh', 
            'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan', 
            'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 
            'Bulgaria', 'Burkina Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 
            'Cape Verde', 'Central African Republic', 'Chad', 'Chile', 'China', 
            'Colombia', 'Comoros', 'Congo', 'Costa Rica', 'Croatia', 'Cuba', 
            'Cyprus', 'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 
            'Dominican Republic', 'East Timor', 'Ecuador', 'Egypt', 'El Salvador', 
            'Equatorial Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Fiji', 
            'Finland', 'France', 'Gabon', 'Gambia', 'Georgia', 'Germany', 
            'Ghana', 'Greece', 'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau', 
            'Guyana', 'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India', 
            'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Jamaica', 
            'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Kuwait', 
            'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 
            'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Madagascar', 
            'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 
            'Mauritania', 'Mauritius', 'Mexico', 'Micronesia', 'Moldova', 'Monaco', 
            'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 
            'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 
            'Nigeria', 'North Korea', 'North Macedonia', 'Norway', 'Oman', 
            'Pakistan', 'Palau', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 
            'Philippines', 'Poland', 'Portugal', 'Qatar', 'Romania', 'Russia', 
            'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Vincent and the Grenadines', 
            'Samoa', 'San Marino', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 
            'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 
            'Somalia', 'South Africa', 'South Korea', 'South Sudan', 'Spain', 
            'Sri Lanka', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria', 
            'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Togo', 'Tonga', 
            'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 
            'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 
            'Uruguay', 'Uzbekistan', 'Vanuatu', 'Vatican City', 'Venezuela', 
            'Vietnam', 'Yemen', 'Zambia', 'Zimbabwe'
        ]);

        // Set nationality to null if not found
        if ($this->nationality != null && !in_array($this->nationality, $this->nationalities->all())) {
            $this->nationality = null;
        }
    }

    public function updatedNationality()
    {
        // Get states/provinces for the selected country
        $this->states = $this->getStatesForCountry($this->nationality);
        
        if ($this->states->isNotEmpty()) {
            $this->state = $this->states->first();
        }

        $this->dispatch('nationality-updated', ['nationality' => $this->nationality]);
        $this->dispatch('state-updated', ['state' => $this->state]);
    }

    public function loadInitialStates()
    {
        if ($this->nationality == null && $this->nationalities->isNotEmpty()) {
            $this->nationality = $this->nationalities->first();
        }
        
        if ($this->nationality) {
            $this->states = $this->getStatesForCountry($this->nationality);
            
            if ($this->state == null || !in_array($this->state, $this->states->toArray())) {
                $this->state = $this->states->first() ?? $this->nationality;
            }
        }

        $this->dispatch('nationality-updated', ['nationality' => $this->nationality]);
        $this->dispatch('state-updated', ['state' => $this->state]);
    }

    public function updatedState()
    {
        $this->dispatch('state-updated', ['state' => $this->state]);
    }

    private function getStatesForCountry($country)
    {
        // Define states/provinces for major countries
        $countryStates = [
            'United States' => ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'],
            'Canada' => ['Alberta', 'British Columbia', 'Manitoba', 'New Brunswick', 'Newfoundland and Labrador', 'Northwest Territories', 'Nova Scotia', 'Nunavut', 'Ontario', 'Prince Edward Island', 'Quebec', 'Saskatchewan', 'Yukon'],
            'Kenya' => ['Baringo', 'Bomet', 'Bungoma', 'Busia', 'Elgeyo-Marakwet', 'Embu', 'Garissa', 'Homa Bay', 'Isiolo', 'Kajiado', 'Kakamega', 'Kericho', 'Kiambu', 'Kilifi', 'Kirinyaga', 'Kisii', 'Kisumu', 'Kitui', 'Kwale', 'Laikipia', 'Lamu', 'Machakos', 'Makueni', 'Mandera', 'Marsabit', 'Meru', 'Migori', 'Mombasa', 'Murang\'a', 'Nairobi', 'Nakuru', 'Nandi', 'Narok', 'Nyamira', 'Nyandarua', 'Nyeri', 'Samburu', 'Siaya', 'Taita-Taveta', 'Tana River', 'Tharaka-Nithi', 'Trans Nzoia', 'Turkana', 'Uasin Gishu', 'Vihiga', 'Wajir', 'West Pokot'],
            'Nigeria' => ['Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Federal Capital Territory', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara'],
            'India' => ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Delhi', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal'],
            'United Kingdom' => ['England', 'Scotland', 'Wales', 'Northern Ireland'],
            'Australia' => ['Australian Capital Territory', 'New South Wales', 'Northern Territory', 'Queensland', 'South Australia', 'Tasmania', 'Victoria', 'Western Australia'],
            'Germany' => ['Baden-Württemberg', 'Bavaria', 'Berlin', 'Brandenburg', 'Bremen', 'Hamburg', 'Hesse', 'Lower Saxony', 'Mecklenburg-Vorpommern', 'North Rhine-Westphalia', 'Rhineland-Palatinate', 'Saarland', 'Saxony', 'Saxony-Anhalt', 'Schleswig-Holstein', 'Thuringia'],
            'France' => ['Auvergne-Rhône-Alpes', 'Bourgogne-Franche-Comté', 'Brittany', 'Centre-Val de Loire', 'Corsica', 'Grand Est', 'Hauts-de-France', 'Île-de-France', 'Normandy', 'Nouvelle-Aquitaine', 'Occitanie', 'Pays de la Loire', 'Provence-Alpes-Côte d\'Azur'],
            'South Africa' => ['Eastern Cape', 'Free State', 'Gauteng', 'KwaZulu-Natal', 'Limpopo', 'Mpumalanga', 'North West', 'Northern Cape', 'Western Cape'],
            // Add more countries as needed
        ];

        return collect($countryStates[$country] ?? [$country]);
    }

    public function render()
    {
        return view('livewire.nationality-and-state-input-fields');
    }
}