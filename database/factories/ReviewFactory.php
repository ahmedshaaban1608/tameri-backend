<?php

namespace Database\Factories;

use App\Models\Tourguide;
use App\Models\Tourist;
use App\Models\Review;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Review::class;
    public function definition(): array
    {
        $titles = array(
            "I highly recommend Tameri!",
            "Tameri is a great resource for travel planning.",
            "Tameri helped me plan the perfect trip to Egypt.",
            "Tameri is a must-use for any traveler.",
            "Tameri is the best travel website I've ever used.",
            "I can't believe how much money I saved using Tameri.",
            "Tameri made my trip to Egypt unforgettable.",
            "Tameri is a lifesaver for travel planning.",
            "I don't know how I traveled without Tameri before.",
            "A Gateway to Adventure: Tameri Exceeded My Expectations",
            "Awe-Inspiring Adventure in Ancient Egypt",
            "Unforgettable Nile Cruise Experience",
            "Cultural Immersion in the Vibrant Souks",
            "Serenity and Relaxation by the Red Sea",
            "Unleashing Wanderlust: Tameri Ignited My Travel Spirit",
            "A Traveler's Paradise: Tameri Made My Dream Trip a Reality",
            "Connecting Travelers Worldwide: Tameri Fosters a Vibrant Community",
            "Unveiling Hidden Gems: Tameri Took Me Off the Beaten Path",
            "Amazing Experience!",
            "An Unforgettable Journey to Egypt",
            "The Perfect Planning Tool for My Egyptian Adventure",
            "My Egyptian Vacation Was Made Easy with Tameri ",
            "A Must-Use Resource for Egypt Travelers",
            "The Best Way to Plan Your Egyptian Adventure",
            "Unforgettable Adventure",
            "Dream Vacation Made Easy",
            "Discover the World: Unveiling the Magic of Tameri",
            "Wanderlust Delight: A Journey of Inspiration on Tameri",
            "Your Passport to Adventure: Tameri Unlocks Global Exploration",
            "Seamless Booking Experience",
            "Adventure of a Lifetime",
            "Hidden Gems Unveiled",
            "Family Fun at its Best",
            "Luxury at its Finest",
            "A Window to the Extraordinary: Tameri Reveals Travel's Hidden Gems",
            "Travel Inspiration at Your Fingertips: Tameri Transports You to New Realms",
            "Curated Experiences, Unforgettable Memories: Tameri Crafts Your Perfect Journey",
            "Connect and Discover: Tameri Builds a Thriving Community of Explorers",
            "Stay Ahead of the Travel Curve: Tameri Keeps You Informed and Inspired",
            "Unlock Cultural Riches: Tameri Dives Deep into Local Traditions",
            "Your Personal Travel Guide: Tameri Navigates You Through Uncharted Territories",
            "Beyond the Horizon with Tameri",
            "Unveiling Egypt's Treasures with Tameri",
            "Wanderlust Delight: A Journey of Inspiration on Tameri",
            "Your Passport to Adventure: Tameri Unlocks Global Exploration",
            "Seamless Booking Experience",
            "Adventure of a Lifetime",
            "Hidden Gems Unveiled",
            "Family Fun at its Best",
            "Unveiling Hidden Gems: Tameri Took Me Off the Beaten Path",
            "Amazing Experience!",
            "An Unforgettable Journey to Egypt",
            "The Perfect Planning Tool for My Egyptian Adventure",
            "I highly recommend Tameri!",
            "Tameri is a great resource for travel planning.",
            "Tameri helped me plan the perfect trip to Egypt."
        );

        $comments = [
            "I recently used Tameri to book a trip to Egypt, and I had a great experience. The website was easy to use and navigate, and I found a great deal on my flights and hotel. I would highly recommend Tameri to anyone looking to book a trip.",
            "I've used Tameri to plan several trips now, and I've always been impressed with the amount of information available on the site. You can find everything from travel guides and destination reviews to tips on how to save money on your trip. I would highly recommend Tameri to anyone planning a trip.",
            "I was so overwhelmed with planning my trip to Egypt, but Tameri made it so easy. The website helped me find the perfect flights, hotel, and activities. I would highly recommend Tameri to anyone planning a trip.",
            "I'm a frequent traveler, and I always use Tameri to book my trips. The website is so easy to use and has so many great features, like the ability to compare prices from different travel providers. I would highly recommend Tameri to anyone who travels.",
            "I've used several different travel websites over the years, but Tameri is by far the best. The website is easy to use, has great deals, and a wide variety of information. I would highly recommend Tameri to anyone who travels.",
            "I was skeptical about using a travel website, but I'm so glad I did. I saved so much money on my trip to Egypt using Tameri. I would highly recommend Tameri to anyone looking to save money on their trip.",
            "I had the best time on my trip to Egypt, and I have Tameri to thank for it. The website helped me plan the perfect trip, and everything went off without a hitch. I would highly recommend Tameri to anyone looking to plan an unforgettable trip.",
            "I'm not a very organized person, so planning trips can be a real pain. But Tameri makes it so easy. The website helps me with everything from finding flights and hotels to booking activities and transportation. I would highly recommend Tameri to anyone who is not very organized.",
            "I've been using Tameri for a few years now, and I can't believe I ever traveled without it. The website makes everything so easy, and it's saved me so much money. I would highly recommend Tameri to anyone who travels.",
            "I stumbled upon Tameri while planning my vacation, and it turned out to be a game-changer. The website's user-friendly interface, comprehensive destination guides, and stunning visuals made my trip planning a breeze. I was able to discover hidden gems and create an unforgettable itinerary. Highly recommended!",
            "My experience with Tameri was nothing short of awe-inspiring. The website provided a wide range of immersive tours, and the booking process was seamless. Exploring the wonders of ancient Egypt was like stepping back in time. From gazing at the majestic pyramids of Giza to marveling at the intricate carvings in the temples of Luxor, every moment was filled with wonder. The knowledgeable guides shared captivating stories and brought the history to life. Egyptian Escapes made my dream of visiting ancient Egypt a reality!",
            "Thanks to Tameri, I embarked on an unforgettable Nile cruise adventure. The website offered various cruise packages, and I found the perfect one to suit my preferences. Sailing along the iconic river, I witnessed the beauty of the Nile Valley and its ancient treasures. The onboard accommodations were comfortable, and the delicious cuisine added a delightful touch to the journey. Tameri truly made my Nile cruise experience exceptional!",
            "Tameri provided me with a truly immersive cultural experience in the vibrant souks of Egypt. The website offered a variety of city tours, and I chose one that allowed me to explore the bustling markets and soak in the local culture. From bargaining for unique souvenirs to sampling delicious street food, I felt the pulse of Egypt's vibrant cities. The guides were knowledgeable and shared fascinating insights about the rich history and traditions. Tameri made my trip to Egypt an unforgettable cultural immersion!",
            "Thanks to Tameri, I discovered a serene oasis by the Red Sea. The website showcased a range of beach destinations, and I found the perfect retreat. With crystal-clear waters, pristine sandy beaches, and vibrant marine life, I experienced true relaxation and tranquility. The seaside resorts offered luxurious accommodations and a variety of water activities. Tameri made my beach getaway a true haven of serenity!",
            "Tameri is a virtual wonderland for travel enthusiasts like me. The website's captivating images, immersive videos, and detailed travel tips transported me to different corners of the world. It inspired me to explore new destinations and provided valuable insights for my future adventures. Thank you, Tameri, for reigniting my wanderlust!",
            "Planning my dream trip was made easy with Tameri. The website's extensive collection of destinations, personalized itineraries, and insider recommendations helped me create a truly unforgettable experience. From booking accommodations to finding the best local attractions, Tameri was my go-to resource. I can't wait to use it for my next adventure!",
            "Tameri goes beyond being just a travel website; it's a thriving community of passionate travelers. I loved connecting with fellow explorers, sharing stories, and gaining valuable insights from their experiences. The platform's interactive forums and social features added an extra layer of excitement to my travel journey. Kudos to Tameri for fostering such a vibrant community!",
            "Thanks to Tameri, I discovered hidden gems that I would have otherwise missed. The website's curated content introduced me to local experiences, lesser-known attractions, and authentic cultural encounters. It's refreshing to have a travel website that focuses on showcasing the true essence of a destination. I can't wait to explore more hidden treasures with Tameri as my guide.",
            "I booked a trip to Paris through Tameri, and it was an incredible experience from start to finish. The website was easy to navigate, and the booking process was seamless. The accommodations were top-notch, and the tour guides were knowledgeable and friendly. I highly recommend Tameri for all your travel needs!",
            "I recently had the opportunity to travel to Egypt for the first time, and it was an absolutely incredible experience. I planned my entire trip using Tameri and I couldn't have been happier with the results. The website made it so easy to find information about different destinations, activities, and accommodations. I was also able to book my flights and hotels directly through the website, which saved me a lot of time and hassle. Once I arrived in Egypt, I was amazed by the beauty of the country. The pyramids of Giza are truly awe-inspiring, and the temples of Luxor are simply breathtaking. I also enjoyed exploring the souks of Cairo and taking a Nile River cruise. Overall, Tameri played a crucial role in making my trip to Egypt unforgettable.",
            "Tameri made my dream vacation a reality! I had always wanted to visit Machu Picchu, and thanks to Tameri, I was able to plan the perfect trip. The website provided detailed information about the best time to visit, the different trekking options, and the must-see attractions in the area. I was able to book everything, from my flights to my accommodations, through Tameri. The trip itself was amazing, and I felt well-prepared thanks to the tips and recommendations I found on the website. I highly recommend Tameri to anyone looking to plan their dream vacation!",
            "Tameri made my solo trip to Japan a breeze. The website's detailed guides and recommendations helped me navigate Tokyo's bustling neighborhoods, experience traditional tea ceremonies, and discover hidden gems. I felt confident exploring on my own, thanks to the valuable insights from Tameri. The community aspect also allowed me to connect with fellow solo travelers and share memorable experiences. Tameri truly enhanced my solo travel adventure!",
            "I've been using Tameri for all my travel planning, and it has never let me down. The website is a one-stop-shop for everything related to travel - from finding the best flight deals to discovering off-the-beaten-path destinations. The user-friendly interface and wealth of information make it my go-to resource. Tameri has become an indispensable part of my travel journey, and I recommend it to all my friends and fellow travelers.",
            "Tameri exceeded my expectations when I used it to plan my road trip across the United States. The website's route planning feature, along with recommendations for attractions and accommodations along the way, made the journey seamless and enjoyable. I discovered hidden gems in small towns and scenic spots that I wouldn't have found otherwise. Tameri turned my road trip into a memorable adventure, and I can't wait to use it for my future travels.",
        ];
        $tourguideId = Tourguide::inRandomOrder()->first()->id;
        $touristId = Tourist::inRandomOrder()->first()->id;
        return [
            'tourist_id'=> $touristId,
            'tourguide_id'=> $tourguideId,
            'title'=> $this->faker->randomElement($titles),
            'comment'=> $this->faker->randomElement($comments),
            'stars'=>$this->faker->numberBetween(3,5),
            'status'=>$this->faker->randomElement(['pending', 'confirmed', 'declined']),
        ];
    }
}
