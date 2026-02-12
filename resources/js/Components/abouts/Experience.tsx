import React from 'react';
import { GraduationCap, Briefcase } from 'lucide-react';

const Experince = () => {
    return (
        <section className="bg-white py-20 px-6 md:px-12 lg:px-24 font-sans">
            {/* Header Section */}
            <div className="text-center mb-16">
                <h2 className="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                    Qualifications & Experience
                </h2>
                <p className="text-slate-500 max-w-2xl mx-auto">
                    Educational background and professional expertise in medical practice
                </p>
            </div>

            {/* Cards Container */}
            <div className="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">

                {/* Medical Education Card */}
                <div className="bg-[#f1f5f9] p-10 rounded-3xl border border-slate-100 transition-hover duration-300 hover:shadow-md">
                    <div className="bg-blue-100 w-14 h-14 rounded-xl flex items-center justify-center mb-8">
                        <GraduationCap className="w-8 h-8 text-blue-600" />
                    </div>

                    <h3 className="text-xl font-bold text-slate-900 mb-6">
                        Medical Education
                    </h3>

                    <ul className="space-y-4">
                        <li className="flex items-center gap-3 text-slate-600">
                            <span className="w-1.5 h-1.5 rounded-full bg-blue-500 shrink-0" />
                            General Practice Specialization
                        </li>
                        <li className="flex items-center gap-3 text-slate-600">
                            <span className="w-1.5 h-1.5 rounded-full bg-blue-500 shrink-0" />
                            Continuous Medical Education (CME) certified
                        </li>
                    </ul>
                </div>

                {/* Professional Experience Card */}
                <div className="bg-[#f1f5f9] p-10 rounded-3xl border border-slate-100 transition-hover duration-300 hover:shadow-md">
                    <div className="bg-blue-100 w-14 h-14 rounded-xl flex items-center justify-center mb-8">
                        <Briefcase className="w-7 h-7 text-blue-600" />
                    </div>

                    <h3 className="text-xl font-bold text-slate-900 mb-6">
                        Professional Experience
                    </h3>

                    <ul className="space-y-4">
                        <li className="flex items-center gap-3 text-slate-600">
                            <span className="w-1.5 h-1.5 rounded-full bg-blue-500 shrink-0" />
                            22+ Years in General Practice
                        </li>
                        <li className="flex items-center gap-3 text-slate-600">
                            <span className="w-1.5 h-1.5 rounded-full bg-blue-500 shrink-0" />
                            Expertise in Pediatric & Geriatric Care
                        </li>
                        <li className="flex items-center gap-3 text-slate-600">
                            <span className="w-1.5 h-1.5 rounded-full bg-blue-500 shrink-0" />
                            Preventive Medicine & Health Screening
                        </li>
                    </ul>
                </div>

            </div>
        </section>
    );
};

export default Experince;