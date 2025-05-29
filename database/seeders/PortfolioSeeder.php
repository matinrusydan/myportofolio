<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Education;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Achievement;
use App\Models\Skill;
use App\Models\Experience;
class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Create Profile
        Profile::create([
            'name' => 'Matin Rusydan',
            'title' => 'Data Engineer',
            'description' => 'With expertise in ETL, big data, and database optimization, I ensure your data architecture runs smoothly to support smarter business decisions.',
            'email' => 'matin.rusydan@gmail.com',
            'phone' => '+62 123 456 789',
            'address' => 'Tasikmalaya, West Java, Indonesia',
            'github_url' => 'https://github.com/matinrusydan',
            'whatsapp_url' => 'https://wa.me/62123456789',
            'telegram_url' => 'https://t.me/matinrusydan',
        ]);

        // Create Education
        $educationData = [
            [
                'year' => '2017',
                'degree' => 'Graduated from Elementary School',
                'institution' => 'SDN 6 Raajapolah',
                'description' => 'Completed my primary education of SDN 6 Raajapolah',
                'order' => 1
            ],
            [
                'year' => '2020',
                'degree' => 'Graduated from Middle School',
                'institution' => 'SMPN 1 Rajapolah',
                'description' => 'Graduated from SMPN 1 Rajapolah',
                'order' => 2
            ],
            [
                'year' => '2023',
                'degree' => 'Graduated from High School',
                'institution' => 'SMAN 6 Tasikmalaya',
                'description' => 'Specialized in the Science stream from SMAN 6 Tasikmalaya.',
                'order' => 3
            ],
            [
                'year' => '2023-Now',
                'degree' => 'Undergraduate at the University of Siliwangi',
                'institution' => 'University of Siliwangi',
                'description' => 'Pursuing a Bachelor\'s degree in Informatics, currently in progress.',
                'order' => 4
            ]
        ];

        foreach ($educationData as $education) {
            Education::create($education);
        }

        // Create Projects
        $projectData = [
            [
                'name' => 'TIEN SALON',
                'description' => 'Salon management system',
                'location' => 'Rajapolah, Tasikmalaya, West Java',
                'is_featured' => true,
                'order' => 1
            ],
            [
                'name' => 'Matbrew Sparepart',
                'description' => 'E-commerce platform for spare parts',
                'location' => 'Rajapolah, Tasikmalaya, West Java',
                'is_featured' => true,
                'order' => 2
            ],
            [
                'name' => 'Data Science',
                'description' => 'Predict Credit',
                'location' => 'Machine Learning Project',
                'is_featured' => true,
                'order' => 3
            ]
        ];

        foreach ($projectData as $project) {
            Project::create($project);
        }

        // Create Testimonials
        $testimonialData = [
            [
                'name' => 'Husni Ayi Nurdin',
                'position' => 'Client Web Matbrew Sparepart',
                'message' => 'Gacor banget web nya, UI nya bagus, lalu memudahkan pengguna.',
                'rating' => 5,
                'is_active' => true,
                'order' => 1
            ],
            [
                'name' => 'Piki Alpyan',
                'position' => 'Client Web UI/UX Design',
                'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'rating' => 5,
                'is_active' => true,
                'order' => 2
            ],
            [
                'name' => 'Fiki Haryono',
                'position' => 'Client Web Matbrew Sparepart',
                'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'rating' => 5,
                'is_active' => true,
                'order' => 3
            ],
            [
                'name' => 'Muhammad Raihzan',
                'position' => 'Client Web Matbrew Sparepart',
                'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'rating' => 5,
                'is_active' => true,
                'order' => 4
            ]
        ];

        foreach ($testimonialData as $testimonial) {
            Testimonial::create($testimonial);
        }
         // Skills
        $skills = [
            ['name' => 'Python', 'description' => 'Advanced programming for data analysis and ETL processes', 'level' => 95, 'order' => 1],
            ['name' => 'SQL', 'description' => 'Database design, optimization, and complex query writing', 'level' => 90, 'order' => 2],
            ['name' => 'AWS', 'description' => 'Cloud infrastructure and data services management', 'level' => 85, 'order' => 3],
            ['name' => 'Apache Spark', 'description' => 'Big data processing and distributed computing', 'level' => 80, 'order' => 4],
            ['name' => 'Docker', 'description' => 'Containerization and deployment automation', 'level' => 85, 'order' => 5],
            ['name' => 'Apache Airflow', 'description' => 'Workflow orchestration and pipeline management', 'level' => 80, 'order' => 6],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Experiences
        $experiences = [
            [
                'position' => 'Senior Data Engineer',
                'company' => 'Tech Solutions Inc.',
                'description' => 'Led the development of data pipeline architecture, implemented ETL processes, and optimized database performance for large-scale applications serving millions of users.',
                'start_date' => '2022-01-01',
                'end_date' => null, // Current job
                'technologies' => 'Python, Apache Spark, AWS, PostgreSQL, Docker',
                'order' => 1,
            ],
            [
                'position' => 'Data Engineer',
                'company' => 'DataFlow Corp',
                'description' => 'Designed and maintained data warehouses, developed automated reporting systems, and collaborated with analytics teams to deliver actionable business insights.',
                'start_date' => '2020-06-01',
                'end_date' => '2021-12-31',
                'technologies' => 'SQL, Apache Airflow, Docker, MongoDB, Python',
                'order' => 2,
            ],
            [
                'position' => 'Junior Data Analyst',
                'company' => 'StartupX',
                'description' => 'Built data visualization dashboards, performed statistical analysis, and supported business decision-making through data-driven insights.',
                'start_date' => '2019-03-01',
                'end_date' => '2020-05-31',
                'technologies' => 'Python, SQL, Tableau, Excel',
                'order' => 3,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }

        // Achievements
        $achievements = [
            [
                'title' => 'AWS Certified Solutions Architect',
                'issuer' => 'Amazon Web Services',
                'description' => 'Validated expertise in designing distributed systems on AWS',
                'date' => '2023-06-15',
                'order' => 1,
            ],
            [
                'title' => 'Best Data Pipeline Architecture',
                'issuer' => 'Tech Innovation Awards',
                'description' => 'Recognized for innovative approach to real-time data processing',
                'date' => '2022-11-30',
                'order' => 2,
            ],
            [
                'title' => 'Google Cloud Professional Data Engineer',
                'issuer' => 'Google Cloud',
                'description' => 'Certified in designing and building data processing systems',
                'date' => '2021-08-20',
                'order' => 3,
            ],
            [
                'title' => 'Apache Spark Developer Certification',
                'issuer' => 'Databricks',
                'description' => 'Proficient in big data processing with Apache Spark',
                'date' => '2021-03-10',
                'order' => 4,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}