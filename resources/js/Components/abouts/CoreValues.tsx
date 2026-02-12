import React from 'react';
import { Heart, ShieldCheck, Users, Award } from 'lucide-react';

const CoreValues = () => {
    const values = [
        {
            icon: <Heart className="w-7 h-7 text-blue-500" />,
            title: "Compassionate Care",
            description: "I treat every patient with empathy, respect, and genuine concern for their wellbeing."
        },
        {
            icon: <ShieldCheck className="w-7 h-7 text-blue-500" />,
            title: "Professional Excellence",
            description: "Committed to maintaining the highest standards of medical practice and patient safety."
        },
        {
            icon: <Users className="w-7 h-7 text-blue-500" />,
            title: "Patient-Centered",
            description: "Your health and comfort are at the center of everything I do."
        },
        {
            icon: <Award className="w-7 h-7 text-blue-500" />,
            title: "Continuous Improvement",
            description: "Always learning and adapting to provide better healthcare services."
        }
    ];

    return (
        <section className="bg-[#f8fafc] py-20 px-6 md:px-12 lg:px-24 font-sans">
            {/* Header Section */}
            <div className="text-center mb-16">
                <h2 className="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                    My Core Values
                </h2>
                <p className="text-slate-500 max-w-2xl mx-auto">
                    The principles that guide my practice and patient care every day
                </p>
            </div>

            <div className="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                {values.map((item, index) => (
                    <div
                        key={index}
                        className="bg-white p-8 rounded-2xl shadow-sm border border-slate-50 flex flex-col items-center text-center transition-all duration-300 hover:shadow-md hover:-translate-y-1"
                    >
                        {/* Icon Container */}
                        <div className="bg-blue-50 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                            {item.icon}
                        </div>

                        <h3 className="text-lg font-bold text-slate-800 mb-4">
                            {item.title}
                        </h3>

                        <p className="text-slate-500 text-sm leading-relaxed">
                            {item.description}
                        </p>
                    </div>
                ))}
            </div>
        </section>
    );
};

export default CoreValues;