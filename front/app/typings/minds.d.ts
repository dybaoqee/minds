// Type definitions for Minds
interface Minds{
 LoggedIn : boolean;
 user: Object;
 wallet : any;
 navigation: MindsNavigation | any;
 cdn_url: string;
}

interface MindsNavigation {
  topbar: any,
  sidebar: any
}

interface Window {
	Minds : Minds;
	componentHandler : any;
}
declare var window:Window;
