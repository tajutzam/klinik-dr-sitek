import { useState, useEffect } from "react";
import { Link, usePage } from "@inertiajs/react"; // Import Link dan usePage
import { Phone, Menu, X } from "lucide-react";

const Navbar = () => {
  const [mobileOpen, setMobileOpen] = useState(false);

  // Mengambil URL saat ini langsung dari context Inertia
  const { url } = usePage();

  const links = [
    { label: "Home", href: "/" },
    { label: "About Us", href: "/about" },
    { label: "Services", href: "/services" },
    { label: "Contact", href: "/contact" },
  ];

  return (
    <nav className="sticky top-0 z-50 bg-background/95 backdrop-blur border-b border-border">
      <div className="container mx-auto flex items-center justify-between py-4 px-4">
        <div>
          <span className="text-lg font-bold text-foreground">Dr. Sitek Ferryanto</span>
          <p className="text-xs text-muted-foreground">General Practitioner</p>
        </div>

        {/* Desktop Links */}
        <ul className="hidden md:flex items-center gap-8">
          {links.map((l) => {
            // Mengecek apakah URL saat ini cocok dengan href link
            const isActive = url === l.href;

            return (
              <li key={l.href}>
                <Link
                  href={l.href}
                  className={`text-sm font-medium transition-colors ${isActive
                    ? "text-slate-950 font-bold"
                    : "text-muted-foreground hover:text-slate-900"
                    }`}
                >
                  {l.label}
                </Link>
              </li>
            );
          })}
        </ul>

        <div className="hidden md:flex items-center gap-4">
          <a href="tel:+62123456789" className="flex items-center gap-2 text-sm text-foreground font-medium">
            <Phone className="w-4 h-4" />
            +62 123 456 789
          </a>
          <Link
            href="/contact"
            className="bg-primary text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-600 transition-colors"
          >
            Mari Konsultasi
          </Link>
        </div>

        <button className="md:hidden" onClick={() => setMobileOpen(!mobileOpen)}>
          {mobileOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
        </button>
      </div>

      {mobileOpen && (
        <div className="md:hidden bg-background border-t border-border px-4 pb-4">
          {links.map((l) => (
            <Link
              key={l.href}
              href={l.href}
              onClick={() => setMobileOpen(false)}
              className={`block py-3 text-sm font-medium ${url === l.href ? "text-slate-950 font-bold" : "text-muted-foreground"
                }`}
            >
              {l.label}
            </Link>
          ))}
          <Link
            href="/contact"
            onClick={() => setMobileOpen(false)}
            className="mt-2 block text-center bg-primary text-white px-5 py-2.5 rounded-lg text-sm font-semibold"
          >
            Mari Konsultasi
          </Link>
        </div>
      )}
    </nav>
  );
};

export default Navbar;