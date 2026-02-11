import { useState } from "react";
import { Phone, Menu, X } from "lucide-react";

const Navbar = () => {
  const [mobileOpen, setMobileOpen] = useState(false);

  const links = [
    { label: "Home", href: "/#home" },
    { label: "About Us", href: "/about" },
    { label: "Services", href: "/#services" },
    { label: "Contact", href: "/#contact" },
  ];

  return (
    <nav className="sticky top-0 z-50 bg-background/95 backdrop-blur border-b border-border">
      <div className="container mx-auto flex items-center justify-between py-4 px-4">
        <div>
          <span className="text-lg font-bold text-foreground">Dr. Sitek Ferryanto</span>
          <p className="text-xs text-muted-foreground">General Practitioner</p>
        </div>

        <ul className="hidden md:flex items-center gap-8">
          {links.map((l) => (
            <li key={l.href}>
              <a href={l.href} className="text-sm font-medium text-muted-foreground hover:text-primary transition-colors">
                {l.label}
              </a>
            </li>
          ))}
        </ul>

        <div className="hidden md:flex items-center gap-4">
          <a href="tel:+62123456789" className="flex items-center gap-2 text-sm text-foreground font-medium">
            <Phone className="w-4 h-4" />
            +62 123 456 789
          </a>
          <a href="#contact" className="bg-primary text-primary-foreground px-5 py-2.5 rounded-lg text-sm font-semibold hover:opacity-90 transition-opacity">
            Mari Konsultasi
          </a>
        </div>

        <button className="md:hidden" onClick={() => setMobileOpen(!mobileOpen)}>
          {mobileOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
        </button>
      </div>

      {mobileOpen && (
        <div className="md:hidden bg-background border-t border-border px-4 pb-4">
          {links.map((l) => (
            <a key={l.href} href={l.href} onClick={() => setMobileOpen(false)} className="block py-3 text-sm font-medium text-muted-foreground hover:text-primary">
              {l.label}
            </a>
          ))}
          <a href="#contact" className="mt-2 block text-center bg-primary text-primary-foreground px-5 py-2.5 rounded-lg text-sm font-semibold">
            Mari Konsultasi
          </a>
        </div>
      )}
    </nav>
  );
};

export default Navbar;
