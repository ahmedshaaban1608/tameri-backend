<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tourguide;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tourguide>
 */
class TourguideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tourguide::class;

    public function definition(): array
    {
        $bio = [
            "Siwa's Eco-Tourism Pioneer",
            "Nubian History and Music Expert",
            "Felucca Captain on the Nile",
            "Red Sea Snorkeling Specialist",
            "Dahab Diving Maestro",
            "Luxor's Living Encyclopedia",
            "Cairo Nightlife Connoisseur",
            "Desert Safari Maestro",
            "Cairo's Urban Historian",
            "Sinai Desert Trekker",
            "Luxor's Night Sky Stargazer",
            "Adventure Expert in Sinai",
            "Sports Tour Guides",
            "Religious Tour Guides",
            "Forest Adventure Specialist",
            "Islamic Art Aficionado",
            "Responsible for Cultural Tourism",
            "Responsible for Artistic Tourism",
            "Responsible for Food Tourism",
            "Religious Cultural Tourism",
            "Coptic Cairo Specialist",
            "Responsible for Cinema Tourism",
            "Fashion Cultural Tourism",
            "Responsible for Botanical Tourism",
            "Responsible for Cultural Tourism for Ancient Trade",
            "Responsible for Craft Tourism",
            "Responsible for Exploratory Cultural Tourism",
            "Responsible for Adventure Tourism",
            "Egyptian Folklore Storyteller",
            "Alexandria's Seaside Historian"
        ];
        $description = [
            "In the heart of Siwa Oasis, Ahmed stands as a beacon for sustainable tourism. His passion for the environment is palpable as he leads eco-friendly tours, immersing visitors in the unique ecosystems and biodiversity of the desert. Picture yourself traversing the ancient canyons, where every step echoes with the whispers of a bygone era. Ahmed doesn't just guide; he paints vivid pictures of Siwa's natural wonders, creating a tapestry of experiences that linger in your memory. From the vibrant sunsets over endless sand dunes to the captivating tales of the oasis, Ahmed ensures that every adventure is a harmonious blend of thrill and ecological appreciation.",
            "Journey into the heart of Nubia with Hamza, where the beats of history and music converge. As a musician and historian, Hamza's tours are a sensory delight, weaving together the threads of Nubian history with the rhythmic traditions that have echoed through the ages. Imagine standing amidst cultural events, surrounded by the vibrant energy of Nuba music, as Hamza shares stories that bring history to life. His tours aren't just explorations; they are celebrations of a rich heritage, leaving you with a deeper connection to the soulful spirit of Nubia.",
            "Embark on a timeless journey along the Nile with Omar, a skilled sailor and storyteller. Glide serenely on a felucca, as Omar narrates tales that intertwine with the gentle lapping of the river. His tours aren't just about the landmarks but about the stories etched into the riverbanks. Feel the significance of the Nile in Egyptian history as you relax on the deck, captivated by the unfolding narratives. Omar's tours are a fluid dance between past and present, offering a unique perspective of Egypt's lifeline.",
            "Dive into the vibrant underwater world of the Red Sea with Ali, an experienced snorkeling guide and marine conservation advocate. His tours are immersive journeys into the kaleidoscopic coral reefs, where every fin stroke reveals the beauty of marine life. Ali's commitment to responsible tourism ensures that each snorkeling experience is not just enjoyable but also contributes to the preservation of this underwater paradise. Join him in a symphony of colors beneath the waves, where the Red Sea's secrets come alive.",
            "Beneath the azure surface of Dahab's waters, Hossam invites you into a realm of wonder. As a skilled diving instructor and marine enthusiast, Hossam's tours transcend the ordinary, offering a deep exploration of the vibrant marine life. His commitment to eco-friendly practices ensures that each dive is a responsible and awe-inspiring encounter with the underwater wonders of Dahab. From majestic coral formations to schools of tropical fish, Hossam's tours are a masterclass in diving and environmental appreciation.",
            "In the heart of Luxor, Youssef becomes your guide through time, revealing the treasures of this ancient city. As a Luxor native, his tours are more than just a stroll through historical sites; they are a journey into the soul of a civilization. Picture yourself standing in the shadow of the colossal statues in the Valley of the Kings as Youssef unveils the stories etched in the stones. With a deep well of knowledge about Karnak Temple and Luxor Temple, Youssef transforms every tour into a living encyclopedia of Luxor's historical significance.",
            "As the sun sets over Cairo, Mohammad invites you to explore the city's vibrant nightlife. His tours are a dynamic fusion of local venues, live music spots, and the pulsating energy that defines Cairo after dark. Follow Mohammad through the city's eclectic entertainment scene, where each venue tells a story of its own. From traditional haunts to modern hotspots, his tours are a kaleidoscopic journey, ensuring you experience the full spectrum of Cairo's nightlife. Join Mohammad for a night to remember in the city that never sleeps.",
            "Across Egypt's arid landscapes, Tarek is your guide to the untamed beauty of the desert. His desert safaris are not just journeys; they are immersive experiences into the heart of the dunes and rock formations. Picture yourself on the crest of a sand dune, the vast expanse unfolding before you as Tarek unveils the secrets of the desert. His expertise in navigating the arid terrain ensures that each safari is a thrilling adventure, where the beauty of the landscape becomes a canvas for unforgettable memories.",
            " Cairo's Urban Historian: In the bustling streets of Cairo, Yaaqoub is your storyteller, unraveling the layers of the city's modern history and architecture. His tours are a voyage through time, where each corner reveals a chapter of Cairo's urban narrative. Imagine strolling through the labyrinthine alleys of Old Cairo as Yaaqoub shares insights into the city's evolution. His tours aren't just history lessons; they are immersive explorations of the city's pulse, offering a nuanced understanding of Cairo's vibrant present amidst its ancient wonders.",
            "Amidst the rugged beauty of the Sinai Desert, Amir leads you on an expedition into the heart of Bedouin traditions. His treks are not just about traversing landscapes; they are opportunities to connect with the cultural richness of the Sinai Peninsula. Picture yourself under the vast expanse of the desert sky, surrounded by towering mountains as Amir shares the stories woven into the very fabric of the Sinai. From ancient traditions to breathtaking vistas, Amir's tours promise an adventure that transcends the ordinary.",
            " Luxor's Night Sky Stargazer: In the tranquil night of Luxor, David invites you to a celestial experience against the backdrop of ancient temples. His stargazing tours are a mesmerizing journey into the cosmos, where the glittering night sky becomes a canvas for celestial stories. Imagine standing amidst the remnants of ancient civilizations, the mysteries of the night sky unfolding above you as David shares his passion for astronomy. His tours are not just about stars; they are about connecting with the eternal beauty that has fascinated humans for centuries.",
            "For those seeking an adrenaline-infused encounter with nature, Kareem leads the way through the dramatic landscapes of the Sinai Peninsula. His tours are a dynamic blend of natural beauty and historical exploration, where each step unravels a new facet of this captivating region. Picture yourself standing atop Mount Sinai at sunrise, the panoramic view of the desert below as Kareem shares insights into the historical significance of the land. From desert treks to seaside adventures, Kareem ensures that every moment is a thrilling and informative experience.",
            "Enter the world of sports with Rafat, an experienced organizer and tour guide specializing in sports events and competitions in Egypt. His tours go beyond the conventional, offering a front-row seat to the excitement of sports in this vibrant country. Whether it's witnessing thrilling competitions or participating in sports-related activities, Rafat's tours are a celebration of the athleticism and passion that define Egypt's sporting culture.",
            "Religious Tour Guides: Immerse yourself in the spiritual richness of Egypt with Hesham, a passionate Islamic calligrapher and tour guide specializing in Islamic art and architecture. His tours are a journey through sacred spaces, where the intricacies of calligraphy and the grandeur of mosques come to life. Picture yourself surrounded by the serene beauty of Islamic art as Hesham unveils the stories behind each masterpiece. From ancient mosques to contemporary expressions of faith, Hesham's tours provide a profound exploration of Egypt's Islamic heritage.",
            " Delve into the heart of Egypt's ecological wonders with Rawan, an environmental biologist guiding tours deep into the forest and desert. Her passion for biodiversity and environmental conservation transforms each tour into an educational and immersive experience. Picture yourself surrounded by the sounds of nature as Rawan shares insights into the diverse flora and fauna. From hidden oases to secluded forest trails, Rawan's tours are a celebration of Egypt's natural treasures.",
            "Islamic Art Aficionado: Step into the world of Islamic art with Aisha, an art historian guiding tours through Cairo's museums and mosques. Her deep knowledge of calligraphy, ceramics, and architecture enriches the cultural experience, providing a nuanced understanding of Islamic artistic traditions. Picture yourself standing before intricate masterpieces as Aisha unveils the stories behind each stroke. From museum exhibits to the tranquil ambiance of mosques, Aisha's tours offer a journey into the captivating world of Islamic art.",
            " seamlessly combines ancient Egyptian wisdom with modern health practices, offering tours that transcend the ordinary. Her approach goes beyond historical sites, incorporating mindfulness and wellness activities to rejuvenate the mind and body. Imagine exploring the wonders of Egypt while engaging in activities that promote well-being and cultural enrichment. Rwda's tours are a holistic experience, where the ancient and the contemporary harmoniously converge.",
            " brings a unique perspective to tourism, combining her love for photography with a deep passion for Egypt. Her tours are a visual feast, capturing the essence of Egypt's landscapes, people, and monuments through the lens. Picture yourself traversing ancient ruins and bustling markets as Yara skillfully frames each moment. From classic compositions to spontaneous snapshots, Yara's tours are an artistic exploration, inviting you to see Egypt through the eyes of a photographer.",
            " doesn't just guide you through historical sites; she takes your taste buds on a journey too. As a foodie and culinary expert, Noura introduces you to the rich flavors of Egypt, blending history with gastronomic delights. Picture yourself savoring traditional dishes in atmospheric locales as Noura shares anecdotes about the culinary heritage of the region. From bustling food markets to hidden gems, Noura's tours promise a feast for both the senses and the soul.",
            "specializes in religious heritage tours, offering insights into Egypt's diverse religious history. From ancient temples to modern mosques, her tours celebrate the cultural tapestry of faith. Picture yourself standing in awe of architectural marvels as Amal shares the stories of religious coexistence and evolution. From sacred rituals to the symbolism embedded in art, Amal's tours provide a profound understanding of Egypt's spiritual journey through the ages.",
            "Explore the rich tapestry of Coptic history with Layla, an expert guiding tours through the old churches and monasteries of Coptic Cairo. Her deep understanding of Egypt's Christian heritage adds a unique perspective to the cultural experience. Picture yourself stepping into centuries-old sanctuaries as Layla unveils the stories preserved in the stones. From intricately adorned churches to serene monastic retreats, Layla's tours offer a captivating journey into the heart of Coptic Cairo.",
            " guides you through the scenes of Egypt captured on the silver screen. From classic films to modern blockbusters, her tours showcase the iconic locations that have graced the big screen. Picture yourself walking through the same streets and landscapes that have set the stage for cinematic masterpieces. Yasmine's tours are a celebration of Egypt's cinematic history, inviting you to step into the reel world of the country's most iconic film moments.",
            " celebrate Egypt's textile and fashion heritage, offering a vibrant exploration of craftsmanship and style. From traditional crafts to contemporary designs, she brings you into a world of Egyptian fabrics and fashion. Picture yourself exploring bustling markets where artisans weave tales into every thread. Omnia's tours are a kaleidoscope of colors and textures, inviting you to discover the intricate beauty woven into Egypt's rich textile traditions.",
            " tours are a botanical delight, offering a deep dive into the diverse flora of Egypt. From ancient gardens to modern conservation efforts, Nada explores the green landscapes that add a refreshing touch to your historical journey. Picture yourself surrounded by blossoming flowers and towering trees as Nada shares insights into the ecological wonders of the region. Her tours are a symphony of scents and colors, providing a refreshing perspective on Egypt's natural beauty.",
            " retraces the footsteps of ancient traders, with a focus on historical trade routes that shaped Egypt's development. Her tours explore the intersections of cultures and the impact of commerce on the country's growth. Picture yourself traversing ancient marketplaces and trade hubs as Farida unveils the economic tapestry that has woven through the ages. From bustling ports to crossroads of civilizations, Farida's tours are a captivating journey into the economic history of Egypt.",
            "tours celebrate Egyptian craftsmanship, from traditional pottery to intricate tapestries. She introduces you to the artisans who preserve Egypt's rich heritage of handcrafted arts. Picture yourself witnessing skilled hands at work, shaping materials into timeless pieces. Sara's tours are a testament to the artistic legacy.",
            "Dive into the vibrant underwater world of the Red Sea with Ali, your expert snorkeling guide. Beyond being an experienced leader, Ali is a marine conservation advocate, ensuring your snorkeling experience is both enjoyable and environmentally responsible. Picture yourself exploring vibrant coral reefs, guided by Ali's insightful commentary on the rich marine life. His commitment to preserving the underwater ecosystem transforms your adventure into a meaningful encounter with the Red Sea's natural wonders.",
    " a passionate diving instructor, on an underwater odyssey in the enchanting waters of Dahab. As a maestro of the deep, Hossam not only unveils the vibrant marine life but also educates on the importance of marine conservation. With Hossam, diving becomes more than a sport; it's an eco-friendly adventure, a journey into the depths guided by a commitment to preserving Dahab's underwater treasures.",
    " a native son of Luxor, is more than a guide—he's a living encyclopedia of the city's treasures. Walk in the footsteps of pharaohs as Youssef unfolds the stories of the Valley of the Kings, the grandeur of Karnak Temple, and the mystique of Luxor Temple. His tours transcend the ordinary, offering a comprehensive understanding of Luxor's historical significance. Youssef doesn't just show you Luxor; he invites you to become a part of its ancient narrative.",
    "Let me be your guide to Cairo's after-hours pulse. His tours are a curated exploration of the city's vibrant nightlife, from local hotspots to live music venues. Beyond the glitz and glamour, Mohammad introduces you to the beating heart of Cairo's dynamic entertainment scene. Your night with Mohammad is not just a tour; it's an immersion into the energy, rhythms, and rich cultural tapestry that make Cairo come alive after dark."

        
        ];
        $avatar = [
            'img1.jpg',
            'img2.jpg',
            'img3.jpg',
            'img4.jpg',
            'img5.jpg',
            'img6.jpg',
            'img7.jpg',
            'img8.jpg',
            'img9.jpg',
            'img10.jpg',
            'img11.jpg',
            'img12.jpg',
            'img13.jpg',
            'img14.jpg',
            'img15.jpg',
            'img16.jpg',
            'img17.jpg',
            'img18.jpg',
            'img19.jpg',
            'img20.jpg',
            'img21.jpg',
            'img22.jpg',
            'img23.jpg',
            'img24.jpg',
            'img25.jpg',
            'img26.jpg',
            'img27.jpg',
            'img28.jpg',
            'img29.jpg',
            'img30.jpg',
        ];
        $profile_img = [
            'profile1.jpeg',
            'profile2.jpeg',
            'profile3.jpeg',
            'profile4.jpeg',
            'profile5.jpeg',
            'profile6.jpeg',
            'profile7.jpeg',
            'profile8.jpeg',
            'profile9.jpeg',
            'profile10.jpeg',
            'profile11.jpeg',
            'profile12.jpeg',
            'profile13.jpeg',
            'profile14.jpeg',
            'profile15.jpeg',
            'profile16.jpeg',
            'profile17.jpeg',
            'profile18.jpeg',
            'profile19.jpeg',
            'profile20.jpeg',
            'profile21.jpeg',
            'profile22.jpeg',
            'profile23.jpeg',
            'profile24.jpeg',
            'profile25.jpeg',
            'profile26.jpeg',
            'profile27.jpeg',
            'profile28.jpeg',
            'profile29.jpeg',
            'profile30.jpeg',
        ];
        $phone = [
            '201096543278',
            '201098927431',
            '201091234567',
            '2010999876543',
            '201098765432',
            '201095432789',
            '201094567890',
            '201091357924',
            '201092468013',
            '201097777777',
            '201098888888',
            '201099999999',
            '201097654321',
            '201092345678',
            '201091111111',
            '201092222222',
            '201093333333',
            '201094444444',
            '201095555555',
            '201096666666',
            '201097771234',
            '201098901234',
            '201094321789',
            '201095432198',
            '201097890123',
            '201096547890',
            '201098907654',
            '201091230987',
            '201097896543',
            '201098760123',
        ];
        
        $user = User::factory()->state(['type' => 'tourguide'])->create();
        return [
            'id' => $user->id,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'birth_date' => $this->faker->date,
            'bio'=> $this->faker->unique()->randomElement($bio),
            'description'=> $this->faker->unique()->randomElement($description),
            'avatar'=> $this->faker->unique()->randomElement($avatar),
            'profile_img'=>$this->faker->unique()->randomElement($profile_img),
            'day_price'=>$this->faker->numberBetween(50,100),
            'phone' => $this->faker->unique()->randomElement($phone),
        ];
    }
}
