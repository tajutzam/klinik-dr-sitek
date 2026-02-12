import React from 'react';

const ContactCTA = () => {
    return (
        <section className="bg-[#eff4f8] py-20 px-6 md:px-12">
            <div className="max-w-4xl mx-auto bg-white rounded-3xl p-12 md:p-16  border border-slate-100 text-center">
                <h2 className="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                    Ada Pertanyaan?
                </h2>
                <p className="text-slate-500 text-lg mb-10 max-w-2xl mx-auto">
                    Hubungi kami untuk informasi lebih lanjut tentang layanan kesehatan yang tersedia
                </p>

                <div className="flex justify-center">
                    <a
                        href="#contact"
                        className="bg-primary hover:opacity-90 text-white font-bold py-4 px-10 rounded-xl shadow-lg shadow-primary/20 transition-all active:scale-95 inline-block"
                    >
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </section>
    );
};

export default ContactCTA;